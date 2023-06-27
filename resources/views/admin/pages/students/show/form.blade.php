@extends('admin.layouts.master')
@section('content')
    <div class="content-body">
        <section id="basic-form-layouts">
            <div class="row match-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-form">
                            </h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form class="form-horizontal form-submit" method="POST" action="{{route('data-user.store')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div
                                                class="form-group required {{ $errors->has("model_number") ? 'has-error' : '' }}">
                                                <label for="projectinput4">型番</label>
                                                <input type="number" class="form-control number"
                                                       placeholder="型番"
                                                       name="model_number"
                                                       value=""
                                                       step="0.01"
                                                       autocomplete="off">
                                                <span
                                                    class="help-block">{{ $errors->first("model_number", ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div
                                                class="form-group required {{ $errors->has("status") ? 'has-error' : '' }}">
                                                <label for="projectinput4">ステータス</label>
                                                <input type="number" class="form-control number"
                                                       placeholder="ステータス"
                                                       name="status"
                                                       value=""
                                                       step="0.01"
                                                       autocomplete="off">
                                                <span
                                                    class="help-block">{{ $errors->first("status", ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div
                                                class="form-group required {{ $errors->has("measuring_time") ? 'has-error' : '' }}">
                                                <label for="projectinput4">測定時刻 <span class="text-danger">*</span></label>
                                                <input type="time" class="form-control number"
                                                       placeholder="測定時刻"
                                                       name="measuring_time"
                                                       value=""
                                                       autocomplete="off"
                                                       required
                                                >
                                                <span
                                                    class="help-block">{{ $errors->first("measuring_time", ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div
                                                class="form-group required {{ $errors->has("measuring_date") ? 'has-error' : '' }}">
                                                <label for="projectinput4">測定日 <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control number"
                                                       placeholder="測定日"
                                                       name="measuring_date"
                                                       value=""
                                                       autocomplete="off"
                                                       required
                                                >
                                                <span
                                                    class="help-block">{{ $errors->first("measuring_date", ':message') }}</span>
                                            </div>
                                        </div>
                                        @foreach(\App\Models\LabelDataUser::DATA_ADD as $key => $value)
                                            <div class="col-md-3">
                                                <div
                                                    class="form-group required {{ $errors->has("$key") ? 'has-error' : '' }}">
                                                    <label for="projectinput4">{{$value}}</label>
                                                    <input type="number" class="form-control number"
                                                           placeholder="{{$value}}"
                                                           name="{{$key}}"
                                                           value=""
                                                           step="0.01"
                                                           autocomplete="off">
                                                    <span
                                                        class="help-block">{{ $errors->first("$key", ':message') }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-check-square-o"></i>追加
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{--    @include('backend.components.overlay')--}}
@endsection
@section('scripts')
    <script type="text/javascript">
        $('body').on('click', '.cancel', function () {
            location.href = '/backend/admin';
        });

        $(document).ready(function () {
            $("#city").change(function (e) {
                e.preventDefault();
                let code = $('option:selected', this).val();
                $url = "/backend/ajax/location"
                $.ajax({
                    type: "post",
                    url: $url,
                    data: {code: code},
                    dataType: "json",
                    beforeSend: function () {
                        $(".overlay").css('display', 'block');
                    },
                    success: function (response) {
                        var html = "<option>-- Chọn Quận Huyện --</option>";
                        var htmlWard = "<option>-- Chọn Xã Phường --</option>";
                        $.each(response, (key, value) => {
                            html += "<option value='" + value.code + "'>" + value.name + "</option>";
                        });
                        $("#district").html(html);
                        $('#ward').html(htmlWard);
                        $(".overlay").css('display', 'none');
                    }
                });
            });
            $("#district").change(function (e) {
                e.preventDefault();
                let code = $('option:selected', this).val();
                $url = "/backend/ajax/location"
                $.ajax({
                    type: "post",
                    url: $url,
                    data: {code: code},
                    dataType: "json",
                    beforeSend: function () {
                        $(".overlay").css('display', 'block');
                    },
                    success: function (response) {
                        var html = "<option>-- Chọn Xã Phường --</option>";
                        $.each(response, (key, value) => {
                            html += "<option value='" + value.code + "'>" + value.name + "</option>";
                        });
                        $("#ward").html(html);
                        $(".overlay").css('display', 'none');
                    }
                });
            });
        });
    </script>
@endsection

