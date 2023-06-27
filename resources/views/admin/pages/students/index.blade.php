@extends('admin.layouts.master')
@section('title')
    Student List
@endsection

@section('content')
    <!-- Breadcrumb -->
    <div class="content-header-left col-md-6 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                {{--        {{ Breadcrumbs::render('admin.index') }} --}}
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-bold-700 text-center">
                        <h1 class="card-title font-weight-bold">学生一覧</h1>
                        <div class="heading-elements">
                            {{--                            <ul class="list-inline mb-0"> --}}
                            {{--                                <li><a href="javscript:void(0)" onclick="getGird();"><i class="fa fa-refresh"></i></a> --}}
                            {{--                                </li> --}}
                            {{--                                <li><a href=""><i class="fa fa-plus"></i></a></li> --}}

                            {{--                            </ul> --}}
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form id="formSearch" action="" method="GET">
                                <div class="row d-flex justify-content-between">
                                    <div class="col-xl-2 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <select type="text" class="form-control" name="month">
                                                <option value="" selected>
                                                    選択してください
                                                </option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}">{{ $i }}月
                                                    </option>
                                                @endfor
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group d-flex">
                                            <input type="text" class="form-control" id="search" name="search"
                                                placeholder="学生を検索">

                                            <a href="javascript:void(0)" id="btnSearch" class="btn btn-primary ml-1">検索</a>

                                        </fieldset>

                                    </div>
                                    {{-- <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <a href="javascript:void(0)" id="btnSearch" class="btn btn-primary">検索</a>
                                    </div> --}}
                                    @if (auth()->user()->role === \App\Models\User::ROLE_ADMIN)
                                        <div class="col-xl-2 col-lg-6 col-md-12 mb-1 text-right">
                                            <a href="javascript:void(0)" id="upload-user" class="btn btn-primary"
                                                data-toggle="modal" data-target="#uploadUserModal">
                                                名簿CSV　UP
                                            </a>
                                        </div>
                                        <div class="col-xl-2 col-lg-6 col-md-12 mb-1 text-right">
                                            <a href="javascript:void(0)" id="btn-upload-data-user" class="btn btn-primary"
                                                data-toggle="modal" data-target="#uploadUserModal2">
                                                データCSV　UP
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </form>
                            <div id="gird">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left show" id="uploadUserModal" tabindex="-1" role="dialog"
        aria-labelledby="uploadUserModal" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-road2"></i>名簿CSV UP</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{--                        <div class="col-md-6"> --}}
                        {{--                            <div class="form-group"> --}}
                        {{--                                <label class="filelabel"> --}}
                        {{--                                    <img src="/images/upload-icon.png" alt=""> --}}
                        {{--                                    <span class="title" id="file-name-upload-data-user">ファイル選択</span> --}}
                        {{--                                    <form method="POST" enctype="multipart/form-data"> --}}
                        {{--                                        @csrf --}}
                        {{--                                        <input class="FileUpload1" id="fileUploadUser" name="upload-file" --}}
                        {{--                                               type="file"/> --}}
                        {{--                                    </form> --}}
                        {{--                                </label> --}}
                        {{--                            </div> --}}
                        {{--                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="filelabel">
                                    <img src="/images/upload-icon.png" alt="">
                                    <span class="title" id="file-name-upload-user">ファイル選択</span>
                                    <input class="FileUpload1 file-upload" id="fileUploadUser" name="upload-file"
                                        type="file" />
                                </label>
                            </div>

                        </div>
                        <div class="col-md-6 text-right">
                            <div class="form-group">
                                <div class="" id="submitUploadDataUser">
                                    <button id="submit-upload-user" class="btn btn-primary">
                                        アップロード
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="message-upload text-center" id="message-upload-user"></div>
                </div>
                <div class="modal-footer title-footer">
                    *ユーザー指定のフォーマットを使用し、サンプルファイルをダウンロード してください。
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-left show" id="uploadUserModal2" tabindex="-1" role="dialog"
        aria-labelledby="uploadUserModal2" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-road2"></i>データCSV　UP</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="filelabel">
                                    <img src="/images/upload-icon.png" alt="">
                                    <span class="title" id="file-name-upload-data-user">ファイル選択</span>
                                    <form method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <label class="">
                                            <input class="FileUpload1 file-upload" id="fileUploadDataUser"
                                                name="upload-file" type="file" />
                                        </label>
                                    </form>
                                </label>
                            </div>
                            <label class="">
                                <input id="overwrite_data" name="overwrite_data" type="checkbox" checked hidden />
                            </label>
                        </div>
                        <div class="col-md-4 text-right">
                            <div class="form-group">
                                <div class="" id="submitUploadDataUser">
                                    <button id="submit-upload-data-user" class="btn btn-primary">
                                        アップロード
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="message-upload text-center" id="message-upload-data-user"></div>
                </div>
                <div class="modal-footer title-footer justify-content-start">
                    *これはユーザー指定のフォーマットです。
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const success = '{{ Session::get('success') }}';

            if (success) {
                toastr.success(success, '');
            }

            let page = 1;
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                page = $(this).attr('href').split('page=')[1];
                getGird();
            });

            $('#btnSearch').on('click', function() {
                page = 1;
                getGird();
            })
            $('#formSearch input').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    page = 1;
                    getGird();
                }
            })
            $('#formSearch select').on('change', function(e) {
                page = 1;
                getGird();
            })

            window.getGird = function() {
                let url = '?page=' + page + '&' + $('#formSearch').serialize();
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(res) {
                        $('#gird').html(res);
                    }
                });
            }

            getGird();

            //upload user
            const formDataUploadUser = new FormData();
            $('#fileUploadUser').on('change', function() {
                $('#file-name-upload-user').html($('#fileUploadUser')[0].files[0].name);
                formDataUploadUser.append('file_user', $('#fileUploadUser')[0].files[0]);
            });

            $("#submit-upload-user").on('click', function() {
                $.ajax({
                    url: '{{ route('upload.user') }}',
                    type: 'POST',
                    data: formDataUploadUser,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        toastr.success('学生情報がアップロードされました', '');
                        setTimeout(function() {
                            location.reload();
                        }, 1700)
                        getGird();
                    },
                    error: function() {
                        toastr.error('アップロードできませんでした', '');
                    }
                });
            });

            //upload data user
            const formDataUploadDataUser = new FormData();
            $('#fileUploadDataUser').on('change', function() {
                $('#file-name-upload-data-user').html($('#fileUploadDataUser')[0].files[0].name);
                formDataUploadDataUser.append('file_data_user', $('#fileUploadDataUser')[0].files[0]);
            });

            $("#submit-upload-data-user").on('click', function() {
                const is_overwrite_data = $('#overwrite_data').is(':checked');
                formDataUploadDataUser.append('is_overwrite_data', is_overwrite_data)

                $.ajax({
                    url: '{{ route('upload.dataUser') }}',
                    type: 'POST',
                    data: formDataUploadDataUser,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        toastr.success('学生情報がアップロードされました', '');
                        setTimeout(function() {
                            location.reload();
                        }, 1700)
                    },
                    error: function() {
                        toastr.error('アップロードできませんでした', '');
                    }
                });
            });

        })
    </script>
@endsection
