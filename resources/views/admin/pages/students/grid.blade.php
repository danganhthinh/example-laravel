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
        @if(auth()->user()->role === \App\Models\User::ROLE_TEACHER)
            <div class="table-responsive">
                <table class="table table-bordered table-csv">
                    <thead class="">
                    <tr>
                        <th class="text-center"></th>
                        <th>身長</th>
                        <th>体重</th>
                        <th>体脂肪</th>
                        <th>筋量</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $key=>$row)
                        <tr>
                            <td>
                                <a href="{{route('students.show', ['student'=>$row->id])}}">
                                    {{$row->display_name ?$row->display_name: $row->name}}
                                </a>
                            </td>
                            <td>
                                {{@$row->dataUser[0]->column_8}}
                            </td>
                            <td>
                                {{@$row->dataUser[0]->column_10}}
                            </td>
                            <td>
                                {{@$row->dataUser[0]->column_11}}
                            </td>
                            <td>
                                {{@$row->dataUser[0]->column_197}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-csv">
                    <thead class="">
                    <tr>
                        <th class="text-center">型番</th>
                        <th>会員ID</th>
                        <th>名前</th>
                        <th>ｶﾅ名</th>
                        <th>生年月日</th>
                        <th>性別</th>
                        <th>体型</th>
                        <th>身長</th>
                        <th>出産(予定)日</th>
                        <th>妊娠前体重</th>
                        <th>初回登録日</th>
                        <th>初回登録時刻</th>
                        <th>アクション</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $key=>$row)
                        <tr>
                            <td>{{@$row->model_number}}</td>
                            <td>
                                <a href="{{route('students.show', ['student'=>$row->id])}}">
                                    {{$row->code}}
                                </a>
                            </td>
                            <td>{{$row->display_name ?$row->display_name: $row->name}}</td>
                            <td>{{$row->kana_name}}</td>
                            <td>{{\Carbon\Carbon::parse($row->date_of_birth)->format('Y/m/d')}}</td>
                            <td>{{$row->sex}}</td>
                            <td>{{$row->figure}}</td>
                            <td>{{$row->height}}</td>
                            <td>{{\Carbon\Carbon::parse($row->expected_date_of_birth)->format('Y/m/d')}}</td>
                            <td>{{$row->pre_pregnancy_weight}}</td>
                            <td>{{\Carbon\Carbon::parse($row->first_registration_date)->format('Y/m/d')}}</td>
                            <td>{{$row->initial_registration_time}}</td>
                            <td>
                                <a href="{{route('students.edit', ['student'=>$row->id])}}">
                                    編集
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @else
        <div class="text-center col-12 font-weight-bold">
            データなし
        </div>
    @endif
    @if (@count($data))
        {{ $data->links('admin.layouts.pagination') }}
    @endif
</div>
