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
                    <th>氏名</th>
                    <th>メールアドレス</th>
                    <th>生年月日</th>
                    <th>チーム</th>
                    <th>アクション</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $key=>$row)
                    <tr>
                        <td>{{@$row->name}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->date_of_birth?\Carbon\Carbon::parse($row->date_of_birth)->format('Y/m/d') : null}}</td>
                        <td>{{$row->team}}</td>
                        <td><a href="{{route('teachers.edit', ['teacher' => $row->id])}}">編集</a></td>
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
    @if (@count($data))
        {{ $data->links() }}
    @endif
</div>
