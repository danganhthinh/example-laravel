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
                                <form class="form-horizontal form-submit" method="POST"
                                      action="{{$action}}">
                                    @if(@$student)
                                        {{ method_field('PUT') }}
                                    @endif
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div
                                                class="form-group required {{ $errors->has("name") ? 'has-error' : '' }}">
                                                <label for="projectinput4">氏名 <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                       placeholder="氏名"
                                                       name="name"
                                                       required
                                                       value="{{@$student->name ? $student->name:old('name')}}">
                                                <span
                                                    class="help-block">{{ $errors->first("name", ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div
                                                class="form-group required {{ $errors->has("email") ? 'has-error' : '' }}">
                                                <label for="projectinput4">メールアドレス <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" class="form-control"
                                                       placeholder="メールアドレス"
                                                       name="email"
                                                       required
                                                       value="{{@$student->email ? $student->email:old('email') }}">
                                                <span
                                                    class="help-block">{{ $errors->first("email", ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div
                                                class="form-group required {{ $errors->has("date_of_birth") ? 'has-error' : '' }} ">
                                                <label for="projectinput4">生年月日</label>
                                                <input
                                                    type="date"
                                                    class="form-control"
                                                    name="date_of_birth"
                                                    value="{{@$student->date_of_birth ?
                                                        \Carbon\Carbon::parse(@$student->date_of_birth )->format("Y-m-d"):''}}"
                                                    autocomplete="true"
                                                    id="datetimepicker"
                                                />
                                                <span
                                                    class="help-block">{{ $errors->first("date_of_birth", ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div
                                                class="form-group required {{ $errors->has("password") ? 'has-error' : '' }}">
                                                <label for="projectinput4">パスワード <span
                                                        class="text-danger">*</span></label>
                                                <input type="password" class="form-control"
                                                       placeholder="パスワード"
                                                       name="password"
                                                       value="">
                                                <span
                                                    class="help-block">{{ $errors->first("password", ':message') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            アップデート
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
        $(document).ready(function () {
            // $('#datetimepicker1').datetimepicker();
        });
    </script>
@endsection

