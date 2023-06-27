<div class="row form-row">
    <style>
        .image-category img {
            height: 100px;
            margin: 0 auto;
            object-fit: contain;
            cursor: pointer;
        }
    </style>
    @if (@count($data))
        <div class="table-responsive">
            <table class="table table-bordered table-csv">
                <thead class="">
                    <tr>
                        <th>タイトル</th>
                        <th>著者</th>
                        <th>カテゴリー</th>
                        <th>投稿日</th>
                        <th>アクション </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $row)
                        <tr>
                            <td>{{ @$row->title }}</td>
                            <td>{{ $row->author }}</td>
                            <td>{{ $row->categories->name }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($row->updated_at)->format('m/d/Y') }}
                            </td>
                            <td>
                                <div>
                                    <button class="btn btn-danger btn-confirm" id="btn-confirm"
                                        post_id="{{ $row->id }}"> <i class="ft-trash-2"></i></button>
                                    {{-- <form method="POST" action="{{ route('posts.destroy', [$row->id]) }}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger delete-user"> <i
                                                    class="ft-trash-2"></i>
                                            </button>
                                        </div>
                                    </form> --}}

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center col-12 font-weight-bold">
            データなし
        </div>
    @endif
    @if (@count($data))
        {{ $data->links('admin.layouts.pagination') }}
    @endif
</div>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
    id="mi-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">削除してもよろしいでしょうか？</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="modal-btn-no">キャンセル</button>
                <button type="button" class="btn btn-primary" id="modal-btn-si">削除</button>
            </div>
        </div>
    </div>
</div>
<script>
    var post_id = ""
    var modalConfirm = function(callback) {
        $(".btn-confirm").on("click", function() {
            post_id = $(this).attr("post_id")
            $("#mi-modal").modal('show');
        });

        $("#modal-btn-si").on("click", function() {
            callback(true);
            $("#mi-modal").modal('hide');
        });

        $("#modal-btn-no").on("click", function() {
            callback(false);
            $("#mi-modal").modal('hide');
        });
    };

    modalConfirm(function(confirm) {
        if (confirm) {
            const url = `/posts/${post_id}`
            $.ajax({
                type: "DELETE",
                url: url,
                dataType: "html",
                beforeSend: function() {},
                success: function(response) {
                    location.reload();
                },
                error: function() {
                    document.getElementById("btn-submit").disabled = false;
                }
            });
        }
    });
</script>
