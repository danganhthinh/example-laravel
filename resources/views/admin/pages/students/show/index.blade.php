@extends('admin.layouts.master')
@section('title')
    {{ $user->name }}
@endsection

@section('content')
    <!-- Breadcrumb -->
    <div class="content-header-left col-md-6 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
            </div>
        </div>
    </div>

    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div style="padding-left: 1.5rem;padding-top: 1.5rem;cursor: pointer;">
                        <i class="ft-arrow-left" onclick="history.back()"></i>
                    </div>
                    @if (@auth()->user()->role === \App\Models\User::ROLE_STUDENT)
                        <div class="card-header text-bold-700 text-center">
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a href="{{ route('data-user.create') }}" title="より多くのデータ"><i
                                                class="fa fa-plus"></i></a></li>
                            </div>
                        </div>
                    @endif

                    <div class="card-header text-bold-700 text-center">
                        <div class="row student-detail">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tbody class="text-left">
                                        <tr>
                                            <td>氏名</td>
                                            <td>{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>年齢</td>
                                            <td>{{ $user->age }}</td>
                                        </tr>
                                        <tr>
                                            <td>メールアドレス</td>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6 align-middle text-right">
                                <img src="{{ asset('/images/default_avatar.png') }}" alt="" height="100%">
                            </div>
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
                                                    <option value="{{ $i }}">
                                                        {{ $i }}月
                                                    </option>
                                                @endfor
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                        <fieldset class="form-group d-flex">
                                            <input type="text" class="form-control" id="search" name="search"
                                                placeholder="指数を検索">
                                            <a href="javascript:void(0)" id="btnSearch" class="btn btn-primary ml-1">検索</a>

                                        </fieldset>
                                    </div>
                                </div>
                            </form>
                            <div id="gird">
                                <div class="table-responsive" style=" max-height: 800px;">
                                    <table class="table table-bordered table-csv">
                                        <thead class="">
                                            <tr>
                                                <th class="text-center"></th>
                                                <th></th>
                                                <th>時系列グラフ</th>
                                                <th>世代 順位</th>
                                                <th>チーム順位</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-students">

                                        </tbody>
                                    </table>
                                </div>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="filelabel">
                                    <img src="/images/upload-icon.png" alt="">
                                    <span class="title" id="file-name-upload-data-user">ファイル選択</span>
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
                            <div class="form-group">
                                <label class="">
                                    <input id="overwrite_data" name="overwrite_data" type="checkbox" value=""
                                        checked hidden />
                                </label>
                            </div>
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
                <div class="modal-footer title-footer">
                    *ユーザー指定のフォーマットを使用し、サンプルファイルをダウンロード してください。
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detail-chart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-detail-chart">時系列グラフ - 筋肉量</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <canvas id="detailChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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

            const getGird = function() {
                let url = '?page=' + page + '&' + $('#formSearch').serialize();
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(res) {
                        console.log('res: ', res.data, 'type of: ', typeof res.data);
                        let html = '';

                        const dataEntries = Object.entries(res.data);
                        const chartDatas = [];
                        const chartOptions = [];

                        for (const [key, value] of dataEntries) {
                            const xValues = value.xValues
                            const yValues = value.yValues
                            const lastValue = value.last_value
                            const rank_in_age = value.rank_in_age
                            const rank_in_team = value.rank_in_team
                            const avg_age = value.avg_age

                            chartDatas[key] = {
                                labels: xValues,
                                datasets: [{
                                    fill: false,
                                    lineTension: 0,
                                    backgroundColor: "#A6CEE3",
                                    borderColor: "#A6CEE3",
                                    data: yValues
                                }]
                            };

                            chartOptions[key] = {
                                legend: {
                                    display: false
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            min: Math.min(...yValues),
                                            max: Math.max(...yValues),
                                            maxTicksLimit: 2
                                        }
                                    }],
                                }
                            }

                            html += `
                            <tr>
                                <td class="title-td"> ${key} </td>
                            <td>
                                ${avg_age}</br>
                                ${lastValue}
                            </td>
                            <td class="detail-modal" data-toggle="modal" id="td-detail" data-target="#detail-chart" data-type="${key}">
                                <canvas id="chart_user_${key}"  height="50"></canvas>
                            </td>
                            <td>${rank_in_age}</td>
                            <td>${rank_in_team}</td>
                            </tr>`;
                        }

                        if (!html) {
                            html += `<tr><td colspan="100%" class="text-center">データなし</td></tr>`
                        }
                        $('#table-students').html(html);

                        for (const [key, item] of dataEntries) {
                            new Chart(`chart_user_${key}`, {
                                type: "line",
                                data: chartDatas[key],
                                options: chartOptions[key]
                            })
                        }

                        $(".detail-modal").on('click', function() {
                            const type = $(this).data('type');
                            $('#modal-title-detail-chart').html(`時系列グラフ - ${type}`)
                            chartOptions[type]['scales']['yAxes'][0]['ticks'][
                                'maxTicksLimit'
                            ] = 8;
                            new Chart("detailChart", {
                                type: "line",
                                data: chartDatas[type],
                                options: chartOptions[type]
                            });
                        });
                    }
                });
            }

            getGird();
        })
    </script>
@endsection
