<?php

namespace App\Http\Controllers;

use App\Consts;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResendingEmailRequest;
use App\Models\PasswordReset;
use App\Models\User;
use App\Repositories\PasswordResetRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends BaseController
{
    protected $userRepository;
    protected $passwordReset;


    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->passwordReset = new PasswordResetRepository();
    }

    public function getLogin()
    {
        if (Auth::check()) {
            return redirect('/');
        } else {
            return view('pages.auths.login');
        }
    }

    public function login(LoginRequest $request)
    {

        try {
            $email = strtolower($request->email);
            $password = $request->password;

            $userCheck = $this->userRepository->checkUserWithEmailCode($email);

            if ($userCheck == null) {
                return $this->sendResponse('false', __('auth.register.incorrectAccount'), Consts::CODE_NO_AUTHORITATIVE);
            }
            // if ($userCheck == false) {
            //     return $this->sendResponse('false', 'Email not verify', Consts::CODE_NO_AUTHORITATIVE);
            // }
            $check = Auth::attempt(['email' => $userCheck->email, 'password' => $password]);
            if ($check == false) {
                return $this->sendResponse('false', __('auth.register.incorrectAccount'), Consts::CODE_NO_AUTHORITATIVE);
            }

            Auth::login($userCheck);
            $request->session()->put('user', Auth::user());

            $user = Auth::user();
            $redirect_url = $user->role === User::ROLE_STUDENT ?
                route('students.show', ['student' => $user->id]) : route('students.index');

            return $this->sendResponse([
                'redirect_url' => $redirect_url
            ]);
        } catch (\Exception $exception) {
            return $this->sendError('error');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }

    public function getRegister()
    {
        return view('pages.auths.register');
    }

    public function postRegister(LoginRequest $request)
    {
        $email = $request->email;
        $name = $request->name;
        $date_of_birth = $request->date_of_birth;
        $password = $request->password;

        $checkUserWithEmail = $this->userRepository->checkUserWithEmail($email);

        if ($checkUserWithEmail) {
            return $this->sendResponse('false', __('auth.register.emailExist'), Consts::CODE_NO_AUTHORITATIVE);
        }
        $user = $this->userRepository->create([
            "email" => $email,
            "name" => $name,
            "date_of_birth" => $date_of_birth,
            "password" => bcrypt($password),
            'email_verified_at' => Carbon::now(),
            "role" => User::ROLE_STUDENT
        ]);
        $redirect_url = $user->role === User::ROLE_STUDENT ?
            route('students.show', ['student' => $user->id]) : route('students.index');
        Auth::login($user);

        return $this->sendResponse([
            'redirect_url' => $redirect_url
        ]);
    }

    public function sendForgetPassword(ResendingEmailRequest $request)
    {
        $email = strtolower($request->email);
        $checkUserWithEmail = $this->userRepository->checkUserWithEmail($email);
        if ($checkUserWithEmail == null) {
            return $this->sendResponse('false', __('auth.register.emailNotExist'), Consts::CODE_NO_AUTHORITATIVE);
        }
        $token = $this->userRepository->getToken();
        $this->passwordReset->updateOrCreate(['token' => $token], ['email' => $email]);
        Mail::to($email)->send(new \App\Mail\ForgetPasswordMail($token, $email));
        return $this->sendResponse('success');
    }

    public function resetPassword($token, $email)
    {
        $DataResetPassword = PasswordReset::where('token', $token)->where('email', $email)->first();
        if (!$DataResetPassword) {
            return abort(419);
        }
        $checkTimeToken = $this->passwordReset->CheckTimeToken($DataResetPassword->updated_at, 60 * 60);
        if ($checkTimeToken == false) {
            return abort(419, 'Not Exist Token');
        }
        return view('pages.auths.change-password', compact('token', 'email'));
    }

    public function changePassword(Request $request)
    {
        $token_reset = $request->token_reset;
        $email = $request->email;
        $password = $request->password;
        $DataResetPassword = PasswordReset::where('token', $token_reset)->where('email', $email)->first();
        if (!$DataResetPassword) {
            return $this->sendResponse('false', 'This session does not exist!', Consts::CODE_NO_AUTHORITATIVE);
        }
        $checkTimeToken = $this->passwordReset->CheckTimeToken($DataResetPassword->updated_at, 60 * 60);
        if ($checkTimeToken == false) {
            return $this->sendResponse('false', 'This session has timed out!', Consts::CODE_NO_AUTHORITATIVE);
        }
        $checkUser = $this->userRepository->checkUserWithEmail($email);

        if ($checkUser == null) {
            return $this->sendResponse('false', 'Email account does not exist', Consts::CODE_NO_AUTHORITATIVE);
        }

        $this->userRepository->update(['password' => bcrypt($password)], $checkUser->id);

        $redirect_url = $checkUser->role === User::ROLE_STUDENT ?
            route('students.show', ['student' => $checkUser->id]) : route('students.index');
        Auth::login($checkUser);
        return $this->sendResponse([
            'redirect_url' => $redirect_url
        ]);
    }

    public function getForgotPassword()
    {
        return view('pages.auths.forgot-password');
    }
}
