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
                    <form id="hk-form" action="{{ route('auths.login') }}" method="post">
                        @csrf
                        <center>
                            <h1>ハイパフォーマンスシステムへようこそ</h1>
                            <p>自分の体は自分で管理する！</p>
                        </center>
                        <div class="d-flex-form">
                            <div class="user-name">
                                <p>
                                    ID
                                </p>
                                <p>
                                    <input type="text" name="email" id="email" placeholder="IDを入力してください"
                                        autocomplete="off">
                                </p>
                            </div>
                            <div class="err-mess" id="err-email"></div>
                            <div class="password">
                                <p>
                                    パスワード
                                </p>
                                <p>
                                    <input type="password" name="password" id="password" placeholder="パスワードを入力してください"
                                        autocomplete="off">
                                </p>
                            </div>
                            <div class="err-mess" id="err-password"></div>
                            <div class="err-mess" id="hk-message"></div>

                            <div class="forgot-password">
                                <a href="{{ route('auths.getForgotPassword') }}" class="forgot-password">
                                    パスワードを忘れた方はこちら
                                </a>
                            </div>
                        </div>
                        <p class="text-center mb-0">
                            <button class="form-submit" type="submit" id="btn-login">ログイン</button>
                        </p>
                        <p class="text-center mb-0">
                            ログインは初めてですか？
                            <span style="color:#B2D235;cursor: pointer">
                                <a href="{{ route('auths.getRegister') }}" style="color:#B2D235;">
                                    サインアップ
                                </a>
                            </span>
                        </p>
                        <div class="login_fields">
                            <input type="hidden" name="user-cookie" value="1" />
                            <input type="hidden" name="custom_login" value="1" />
                        </div>
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
                const errorEmailRequired = "IDは必須項目です";
                const errorPasswordRequired = "パスワードは必須項目です";

                $('#email').keyup(function() {
                    $('#hk-message').html("");
                    if ($(this).val() === "") {
                        $("#err-email").text(errorEmailRequired);
                        return;
                    }
                    $("#err-email").html("");

                })

                $('#password').keyup(function() {
                    $('#hk-message').html("");

                    if ($(this).val() === "") {
                        $("#err-password").text(errorPasswordRequired);
                        return;
                    }
                    $("#err-password").html("");

                })

                $('#hk-form').submit(function(e) {
                    e.preventDefault();

                    const email = $('#email').val()
                    const password = $('#password').val()
                    var countErr = 0;
                    if (email === "") {
                        $("#err-email").text(errorEmailRequired);
                        countErr = 1
                    }

                    if (password === "") {
                        $("#err-password").text(errorPasswordRequired);
                        countErr = 1
                    }
                    if (countErr > 0) {
                        return
                    }

                    var data = {};
                    var ArrayForm = $(this).serializeArray();
                    $.each(ArrayForm, function() {
                        data[this.name] = this.value;
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{ route('auths.login') }}",
                        data: {
                            ...data
                        },
                        dataType: "html",
                        beforeSend: function() {},
                        success: function(response) {
                            const result = JSON.parse(response);
                            if (result.code === 200) {
                                window.location.replace(result.data.redirect_url);
                            } else {
                                $('#hk-message').html(result.message);
                            }
                        },
                        error: function(err) {
                            $('#hk-message').html("Sever Error");
                        }
                    });
                });
            });
        })(jQuery);
    </script>
@endsection
