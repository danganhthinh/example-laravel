<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\TeacherController;
use \App\Http\Controllers\StudentController;
use \App\Http\Controllers\DataUserCotroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'getLogin'])->name('auths.getLogin');
Route::post('/login', [AuthController::class, 'login'])->name('auths.login');

Route::get('/logout', [AuthController::class, 'logout'])->name('auths.logout');

Route::get('/register', [AuthController::class, 'getRegister'])->name('auths.getRegister');
Route::post('/register', [AuthController::class, 'getRegister'])->name('auths.register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('auths.postRegister');
Route::get('/forgot-password', [AuthController::class, 'getForgotPassword'])->name('auths.getForgotPassword');
Route::post('/send-forget-password', [AuthController::class, 'sendForgetPassword'])->name('auths.sendForgetPassword');
Route::get('/password/reset/{token}/{email}', [AuthController::class, 'resetPassword']);
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('auths.changePassword');

Route::get('/post/{id}', [PostController::class, 'detail'])->name('post.detail');

Route::group(['middleware' => 'auth.login'], function () {
    Route::resource('teachers', TeacherController::class)
        ->middleware('auth.role:' . \App\Models\User::ROLE_ADMIN);
    Route::post('students/upload-user', [StudentController::class, 'uploadUser'])
        ->name('upload.user')
        ->middleware('auth.role:' . \App\Models\User::ROLE_ADMIN);
    Route::post('students/upload-data-user', [StudentController::class, 'uploadDataUser'])
        ->name('upload.dataUser')
        ->middleware('auth.role:' . \App\Models\User::ROLE_ADMIN);
    Route::resource('students', StudentController::class)
        ->middleware('auth.role:' . \App\Models\User::ROLE_ADMIN . '|' . \App\Models\User::ROLE_TEACHER);
    Route::resource('students/data-user', DataUserCotroller::class)
        ->middleware('auth.role:' . \App\Models\User::ROLE_STUDENT);

    Route::resource('posts', PostController::class)
        ->middleware('auth.role:' . \App\Models\User::ROLE_ADMIN);

    Route::resource('categories', CategoryController::class)
        ->middleware('auth.role:' . \App\Models\User::ROLE_ADMIN);
});
