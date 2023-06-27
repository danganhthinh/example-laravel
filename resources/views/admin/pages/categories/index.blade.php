@extends('admin.layouts.master')
@section('title')
    ブログ
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
                        <h1 class="card-title font-weight-bold">カテゴリー</h1>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form id="formSearch" action="" method="GET">
                                <div class="row">
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
                                    <div class="col-xl-2 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <input type="text" class="form-control" id="search" name="search"
                                                placeholder="カテゴリーを検索">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-4 col-lg-12 col-md-12 mb-1">
                                        <a href="javascript:void(0)" id="btnSearch" class="btn btn-primary">検索</a>
                                    </div>
                                    <div class="col-xl-4 col-lg-12 col-md-12 mb-1 text-right">
                                        <a href="/categories/create" id="btn-create-data-blog" class="btn btn-primary">
                                            カテゴリー追加
                                        </a>
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
        $(document).ready(function() {
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
        })

    </script>
@endsection
