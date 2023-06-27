@extends('layouts.auth')

@section('css')
    <link href="{{ asset('css/auth/index.css') }}" rel="stylesheet">
@endsection


@section('content')
    <div class="section-inner">
        <div class="row">
            <main id="site-content">
                <div class="owl-carousel item">
                    <div><img src="{{ asset('/images/banner1.png') }}" /></div>
                    <div><img src="{{ asset('/images/banner1.png') }}" /></div>
                    <div><img src="{{ asset('/images/banner1.png') }}" /></div>
                    <div><img src="{{ asset('/images/banner1.png') }}" /></div>
                    <div><img src="{{ asset('/images/banner1.png') }}" /></div>
                </div>
            </main>
            <div class="page-form">
                <div class="box-form">
                    <form id="hk-form" action="">
                        @csrf
                        <input type="hidden" name="token_reset" id="token_reset" value="{{ $token }}">
                        <input type="hidden" name="email" id="email" value="{{ $email }}">
                        <a href="/forgot-password">
                            <img src="/images/previous-page.png" alt="">
                        </a>
                        <h1>パスワード再設定</h1>
                        <p>新しいパスワードを設定します。</p>
                        <div class="d-flex-form">
                            <p>新しいパスワード</p>
                            <p>
                                <input type="password" name="password" id="password" placeholder="新しいパスワードを入力してください">
                            </p>
                        </div>
                        <div class="err-mess" id="err-password"></div>

                        <div class="d-flex-form">
                            <p>新しいパスワード（確認）</p>
                            <p>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    placeholder="新しいパスワードを再入力してください">
                            </p>
                        </div>
                        <div class="err-mess" id="err-password_confirmation"></div>

                        <div id="hk-message"></div>

                        <p class="text-center mb-0">
                            <button class="form-submit" type="submit">
                                ログイン
                            </button>
                        </p>
                    </form>
                    <div style="color:#8C8C8C">2023 All Right Reserved</div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/js/jquery-3.2.1.min.js') }}"></script>

    <script>
        (function($) {
            $(document).ready(function() {
                const errorPasswordRequired = "新しいパスワードは必須項目です";
                const errorPasswordConfirmRequired = "新しいパスワードは必須項目です";
                const errorPasswordNotMatch = "パスワードとパスワードの確認が一致しません";
                
                $('#password').keyup(function() {
                    $('#hk-message').html("");

                    if ($(this).val() === "") {
                        $("#err-password").text(errorPasswordRequired);
                        return;
                    }
                    $("#err-password").html("");

                })

                $('#password_confirmation').keyup(function() {
                    $('#hk-message').html("");

                    if ($(this).val() === "") {
                        $("#err-password_confirmation").text(errorPasswordConfirmRequired);
                        return;
                    }

                    if ($(this).val() && $(this).val() !== $('#password').val()) {
                        $("#err-password_confirmation").text(errorPasswordNotMatch);
                        return;
                    }

                    $("#err-password_confirmation").html("");

                })
                $('#hk-form').submit(function(e) {
                    e.preventDefault();
                    const password = $('#password').val()
                    const passwordConfirm = $('#password_confirmation').val()

                    var count = 0;
                    if (password === "") {
                        $("#err-password").text(errorPasswordRequired);
                        count = 1
                    }

                    if (passwordConfirm === "") {
                        $("#err-password_confirmation").text(errorPasswordConfirmRequired);
                        count = 1
                    }

                    if (passwordConfirm && passwordConfirm !== password) {
                        $("#err-password_confirmation").text(errorPasswordNotMatch);
                        count = 1
                    }

                    if (count > 0) {
                        return
                    }
                    var data = {};
                    var ArrayForm = $(this).serializeArray();
                    $.each(ArrayForm, function() {
                        data[this.name] = this.value;
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{ route('auths.changePassword') }}",
                        data: {
                            ...data
                        },
                        dataType: "html",
                        beforeSend: function() {},
                        success: function(response) {
                            const result = JSON.parse(response);
                            if (result.code === 200) {
                                window.location.replace("/");
                            } else {
                                $('#hk-message').html(result.message);
                            }
                        }
                    });
                });
            });
        })(jQuery);
    </script>
@endsection
