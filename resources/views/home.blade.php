@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header"><i class="fas fa-home"></i> {{ $user->name }}さんのマイページ</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h5 class="my-1 p-2 border shadow">■ 現在の予約申し込み状況</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>日付</th>
                                <th>希望時間</th>
                                <th>区分</th>
                                <th>謝礼額</th>
                                <th>シェフ名</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$reservations)
                            <tr><td colspan="6">現在、申し込み済みの予約はありません。</td></tr>
                            @endif
            
                            @foreach ($reservations as $key => $reservation)
                            <tr>
                                <td>{{ $reservation['date'] }}</td>
                                <td>{{ $reservation['visit_time_str'] }}</td>
                                <td>{{ $reservation['meal_type'] }}<br />
                                <small>{{ $reservation['comment'] }}</small></td>
                                <td>{{ $reservation['price_str'] }}<br />
                                <td><a href="/workerinfo?wid={{ $reservation['worker_id'] }}">{{ $reservation['nickname'] }}</a></td>
                                <td><a href="{{ route('users.reserve.edit',$reservation['id']) }}" class="badge badge-secondary">キャンセル</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $reserve_pagelinks !!}

                    <h5 class="my-3 p-2 border border shadow">■ 登録情報</h5>
                    <ul>
                        <li>お名前：{{ $user->name }}</li>
                        <li>メール：{{ $user->email }}</li>
                        <li>住所：{{ $user->area()->value("name")." ".$user->address }}</li>
                        <li>電話番号：{{ $user->phone }}</li>
                    </ul>
                    <a href="{{ route('users.setting') }}" class="btn btn-info">登録内容の変更</a><br />
                    <a href="/workerslist?area_id={{$user->area_id}}" class="btn btn-link"><i class="fas fa-angle-double-right"></i> 登録地域のシェフを探す</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
