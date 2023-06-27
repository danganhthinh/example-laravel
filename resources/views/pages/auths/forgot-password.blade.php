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
                        <a href="/login">
                            <img src="/images/previous-page.png" alt="">
                        </a>
                        <h1>パスワードをお忘れの方</h1>
                        <p>パスワードをリセットするには、登録したアカウントのメールアドレスを入力してください。</p>
                        <p style="display:none" id="hk-success">
                            パスワード回復情報がメールに送信されました。あなたのメールをチェック！
                        </p>
                        <div class="d-flex-form">
                            <p>メールアドレス</p>
                            <p>
                                <input type="text" name="email" id="email" placeholder="メールアドレスを入力してください">
                            </p>
                        </div>
                        <div class="err-mess" id="err-email"></div>

                        <div id="hk-message"></div>

                        <p class="text-center mb-0">
                            <button id="btn-submit" class="form-submit" type="submit">
                                次へ
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
                // Set the options that I want
                toastr.options = {
                    "closeButton": true,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "10000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

                const regexEmail =
                    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                const errorEmailRequired = "メールアドレスは必須項目です";
                const errorEmailInvalid = "メールアドレスが無効です";

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


                $('#hk-form').submit(function(e) {
                    e.preventDefault();
                    const email = $('#email').val()

                    var countErr = 0;
                    if (email === "") {
                        $("#err-email").text(errorEmailRequired);
                        countErr = 1
                    }

                    if (email && !email.match(regexEmail)) {
                        $("#err-email").text(errorEmailInvalid);
                        countErr = 1
                    }

                    if (countErr > 0) {
                        return
                    }
                    document.getElementById("btn-submit").disabled = true;

                    var data = {};
                    var ArrayForm = $(this).serializeArray();
                    $.each(ArrayForm, function() {
                        data[this.name] = this.value;
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{ route('auths.sendForgetPassword') }}",
                        data: {
                            ...data
                        },
                        dataType: "html",
                        beforeSend: function() {},
                        success: function(response) {
                            const result = JSON.parse(response);
                            document.getElementById("btn-submit").disabled = false;
                            if (result.message == 'success') {
                                toastr.success("メールをご確認ください");
                            }else{
                                toastr.error(result?.message);

                            }
                        },
                        error: function() {
                            document.getElementById("btn-submit").disabled = false;
                        }
                    });
                });
            });
        })(jQuery);
    </script>
@endsection
