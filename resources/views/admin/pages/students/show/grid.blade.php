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
                    <th class="text-center"></th>
                    <th></th>
                    <th>時系列グラフ</th>
                    <th>世代 順位</th>
                    <th>チーム順位</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $key=>$row)
                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
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
</div>
<div class="tb-paginate float-md-right">

</div>
