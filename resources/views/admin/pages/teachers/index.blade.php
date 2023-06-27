@extends('admin.layouts.master')
@section('title')
    Teacher List
@endsection

@section('content')
    <!-- Breadcrumb -->
    <div class="content-header-left col-md-6 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                {{--        {{ Breadcrumbs::render('admin.index') }}--}}
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">教師リスト</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li>
                                <li><a href="{{route('teachers.create')}}" title="新しい先生を追加する"><i class="fa fa-plus"></i></a></li>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form id="formSearch" action="" method="GET">
                                <div class="row">
                                    <div class="col-xl-2 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" id="search" name="search"
                                                   placeholder="氏名">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                        <a href="javascript:void(0)" id="btnSearch" class="btn btn-primary">検索</a>
                                    </div>
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            const success = '{{Session::get('success')}}';

            if (success){
                toastr.success(success, '');
            }

            let page = 1;
            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();
                page = $(this).attr('href').split('page=')[1];
                getGird();
            });

            $('#btnSearch').on('click', function () {
                page = 1;
                getGird();
            })
            $('#formSearch input').on('keyup', function (e) {
                if (e.keyCode === 13) {
                    page = 1;
                    getGird();
                }
            })
            $('#formSearch select').on('change', function (e) {
                page = 1;
                getGird();
            })

            window.getGird = function () {
                let url = '?page=' + page + '&' + $('#formSearch').serialize();
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function (res) {
                        $('#gird').html(res);
                    }
                });
            }

            getGird();

            // $('body').on('click', '.delete', function () {
            //     let id = $(this).data('id');
            //     swal({
            //         title: "Xóa ",
            //         text: "Bạn Muốn Xóa Công Ty Mỹ Phẩm Này?",
            //         icon: "warning",
            //         buttons: {
            //             cancel: {
            //                 text: "Không",
            //                 value: null,
            //                 visible: true,
            //                 className: "",
            //                 closeModal: true,
            //             },
            //             confirm: {
            //                 text: "Có",
            //                 value: true,
            //                 visible: true,
            //                 className: "bg-danger",
            //                 closeModal: false
            //             }
            //         }
            //     }).then((isConfirm) => {
            //         if (isConfirm) {
            //             $.ajax({
            //                 method: 'delete',
            //                 url: 'admin/' + id,
            //                 headers: {
            //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //                 },
            //                 success: function (res) {
            //                     if (res == 1) {
            //                         getGird();
            //                         swal({
            //                             title: "Đã Xóa!",
            //                             text: "Xóa Thành Công",
            //                             icon: "success",
            //                             buttons: {
            //                                 confirm: {
            //                                     text: "OK",
            //                                     className: "btn-primary",
            //                                     closeModal: true
            //                                 }
            //                             }
            //                         })
            //                     } else {
            //                         swal("Lỗi!", "Không Xóa Được", "error");
            //                     }
            //                 },
            //                 error: function () {
            //                     swal("Lỗi!", "Không Xóa Được", "error");
            //                 }
            //             })
            //         }
            //     });
            // })

        })
    </script>
@endsection
