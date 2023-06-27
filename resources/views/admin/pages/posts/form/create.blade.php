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
                                    action="{{ route('posts.store') }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div
                                                class="form-group required {{ $errors->has('author') ? 'has-error' : '' }}">
                                                <label for="projectinput4">*タイトル</label>
                                                <input type="text" class="form-control" placeholder="タイトル" name="author"
                                                    autocomplete="off" required> <span
                                                    class="help-block">{{ $errors->first('author', ':message') }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div
                                                class="form-group required {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                                <label for="projectinput4">*カテゴリー</label>
                                                <select type="text" class="form-control" name="category_id" required>
                                                    <option value="" selected disabled>
                                                        --カテゴリー--
                                                    </option>
                                                    @foreach ($categories as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span
                                                    class="help-block">{{ $errors->first('category_id', ':message') }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group required {{ $errors->has('title') ? 'has-error' : '' }}">
                                                <label for="projectinput4">*サムネイル</label>
                                                <input id="thumbnail" type="file" required />
                                                <span class="help-block">{{ $errors->first('title', ':message') }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group required {{ $errors->has('title') ? 'has-error' : '' }}">
                                                <label for="projectinput4">*筆者</label>
                                                <input type="text" class="form-control" placeholder="筆者" name="title"
                                                    autocomplete="off" required>
                                                <span class="help-block">{{ $errors->first('title', ':message') }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div
                                                class="form-group required {{ $errors->has('content') ? 'has-error' : '' }}">
                                                <label for="projectinput4">*内容</label>
                                                <textarea type="text" class="form-control number" placeholder="内容" name="content" autocomplete="off" required></textarea>
                                                <span class="help-block">{{ $errors->first('content', ':message') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            投稿
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
                var file = ""

                FilePond.registerPlugin(FilePondPluginImagePreview);

                const inputElement = document.getElementById('thumbnail');

                // Create a FilePond instance
                const pond = FilePond.create(inputElement);
                pond.on("removefile", (error, data) => {
                    if (error) {
                        console.log("Oh no");
                        return;
                    }
                    file = ""
                });

                pond.on("addfile", (error, data) => {
                    if (error) {
                        console.log("Oh no");
                        return;
                    }

                    file = data.file
                });

                $('#post-form').submit(function(e) {
                    e.preventDefault();
                    var data = {};
                    var ArrayForm = $(this).serializeArray();
                    $.each(ArrayForm, function() {
                        data[this.name] = this.value;
                    });
                    var formDataUpload = new FormData();
                    formDataUpload.append("thumbnail", file);
                    formDataUpload.append("author", data.author);
                    formDataUpload.append("category_id", data.category_id);
                    formDataUpload.append("content", data.content);
                    formDataUpload.append("title", data.title);
                    formDataUpload.append("_token", data._token);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('posts.store') }}",
                        enctype: "multipart/form-data",
                        data: formDataUpload,
                        processData: false,
                        contentType: false,
                        beforeSend: function() {},
                        success: function(response) {
                            if (response.code === 200) {
                                window.location.replace("/posts");
                            } else {
                                alert('error')
                            }
                        },
                        error: function(err) {
                            alert('error')
                        }
                    });
                });
            });
        })(jQuery);
    </script>
@endsection
