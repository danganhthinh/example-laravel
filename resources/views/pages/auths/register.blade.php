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
                    <form id="hk-form" action="" autocomplete="off">
                        @csrf
                        <center>
                            <h1>ハイパフォーマンスシステムへようこそ</h1>
                            <p>自分の体は自分で管理する！</p>
                        </center>
                        <div class="d-flex-form">
                            <div class="user-name">
                                <p>
                                    氏名

                                </p>
                                <p>
                                    <input type="text" name="name" id="name" placeholder="氏名を入力してください">
                                </p>
                            </div>
                            <div class="err-mess" id="err-name"></div>

                            <div class="email">
                                <p>メールアドレス</p>
                                <p>
                                    <input type="text" name="email" id="email" placeholder="メールアドレスを入力してください">
                                </p>
                            </div>
                            <div class="err-mess" id="err-email"></div>

                            <div class="date">
                                <p>
                                    生年月日
                                </p>
                                <p>
                                    <input type="date" name="date_of_birth" id="date_of_birth" max='2000-13-13'
                                        placeholder="生年月日を入力してください">
                                </p>
                            </div>
                            <div class="err-mess" id="err-date_of_birth"></div>

                            <div class="password">
                                <p>
                                    パスワード
                                </p>
                                <p>
                                    <input type="password" name="password" id="password" placeholder="パスワードを入力してください">
                                </p>
                            </div>
                            <div class="err-mess" id="err-password"></div>
                        </div>
                        <p class="text-center">
                        <div id="hk-message" class="hk-message">
                        </div>
                        </p>
                        <p style="display:none" id="hk-success">
                            Register success. Click <a href="{{ route('auths.getLogin') }}">here</a> login.
                        </p>
                        <p class="text-center mb-0">
                            <button class="form-submit" type="submit">サインアップ</button>
                        </p>
                        <p class="text-center mb-0">
                            アカウントをお持ちですか？ &nbsp;<span><a style="color:#000;cursor: pointer" class="font-weight-bold"
                                    href="{{ route('auths.getLogin') }}">ログイン</a></span>
                        </p>
                    </form>
                    <div style="color:#8C8C8C" class="mt-3">2023 All Right Reserved</div>
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
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth() + 1; //January is 0!
                var yyyy = today.getFullYear();

                if (dd < 10) {
                    dd = '0' + dd;
                }

                if (mm < 10) {
                    mm = '0' + mm;
                }

                today = yyyy + '-' + mm + '-' + dd;
                document.getElementById("date_of_birth").setAttribute("max", today);
                const regexEmail =
                    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                const errorNameRequired = "氏名は必須項目です";
                const errorEmailRequired = "メールアドレスは必須項目です";
                const errorEmailInvalid = "メールアドレスが無効です";
                const errorDobRequired = "生年月日は必須項目です";
                const errorPasswordRequired = "パスワードは必須項目です";

                $('#name').keyup(function() {
                    $('#hk-message').html("");
                    if ($(this).val() === "") {
                        $("#err-name").text(errorNameRequired);
                        return;
                    }
                    $("#err-name").html("");

                })

                $('#email').keyup(function() {
                    $('#hk-message').html("");
                    if ($(this).val() === "") {
                        $("#err-email").text(errorEmailRequired);
                        return;
                    }
                    if ($(this).val() && !$(this).val().match(regexEmail)) {
                        $("#err-email").text(errorEmailInvalid);
                        return
                    }
                    $("#err-email").html("");

                })

                $('#date_of_birth').change(function() {
                    $('#hk-message').html("");
                    var curDate = new Date();
                    var inputDate = new Date($(this).val())
                    if ($(this).val() === "") {
                        $("#err-date_of_birth").text(errorDobRequired);
                        return;
                    }
                    if ($(this).val() && inputDate.getTime() > curDate.getTime()) {
                        $("#err-date_of_birth").text("生年月日は現在の日付よりも前の日付である必要があります");
                        return;
                    }

                    $("#err-date_of_birth").html("");

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
                    const name = $('#name').val()
                    const email = $('#email').val()
                    const date_of_birth = $('#date_of_birth').val()
                    const password = $('#password').val()
                    var countErr = 0;

                    if (name === "") {
                        $("#err-name").text(errorNameRequired);
                        countErr = 1
                    }
                    if (email === "") {
                        $("#err-email").text(errorEmailRequired);
                        countErr = 1
                    }

                    if (date_of_birth === "") {
                        $("#err-date_of_birth").text(errorDobRequired);
                        countErr = 1
                    }
                    if (password === "") {
                        $("#err-password").text(errorPasswordRequired);
                        countErr = 1
                    }

                    if (email && !email.match(regexEmail)) {
                        $("#err-email").text(errorEmailInvalid);
                        countErr = 1
                    }

                    var curDate = new Date();
                    var inputDate = new Date(date_of_birth)

                    if (date_of_birth && inputDate.getTime() > curDate.getTime()) {
                        $("#err-date_of_birth").text("生年月日は現在の日付よりも前の日付である必要があります");
                        return;
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
                        url: "{{ route('auths.postRegister') }}",
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
                        }
                    });
                });
            });
        })(jQuery);
    </script>
@endsection
