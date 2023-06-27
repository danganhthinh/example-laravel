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
                                <form id="post-form" class="form-horizontal form-submit" method="POST"
                                    action="{{ route('categories.store') }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">
                                                <label for="projectinput4">*カテゴリー名</label>
                                                <input type="text" class="form-control" placeholder="カテゴリー名"
                                                    name="name" autocomplete="off" required> <span
                                                    class="help-block">{{ $errors->first('name', ':message') }}</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            追加
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
    {{--    @include('backend.components.overlay') --}}
@endsection
@section('scripts')
    <script type="text/javascript">
        (function($) {
            $(document).ready(function() {
                $('#post-form').submit(function(e) {
                    e.preventDefault();
                    var data = {};
                    var ArrayForm = $(this).serializeArray();
                    $.each(ArrayForm, function() {
                        data[this.name] = this.value;
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('categories.store') }}",
                        data: {
                            ...data
                        },
                        beforeSend: function() {},
                        success: function(response) {
                            if (response.code === 200) {
                                window.location.replace("/categories");
                            } else {
                                alert('error')
                            }
                        },
                        error: function(err) {
                            console.log(err);
                            return
                            alert('error')
                        }
                    });
                });
            });
        })(jQuery);
    </script>
@endsection
