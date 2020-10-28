@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $user->name }}さんのマイページ</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h5>■ 現在の予約申し込み状況</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>日付</td>
                                <td>希望時間</td>
                                <td>区分</td>
                                <td>謝礼額</td>
                                <td>シェフ名</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $key => $reservation)
                            <tr>
                                <td>{{ $reservation['date_str'] }}</td>
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

                    <h5>■ 登録情報</h5>
                    <ul>
                        <li>お名前：{{ $user->name }}</li>
                        <li>メール：{{ $user->email }}</li>
                        <li>住所：{{ $user->address }}</li>
                        <li>電話番号：{{ $user->phone }}</li>
                    </ul>
                    ⇒<a href="#">登録内容の変更</a><br />
                    ⇒<a href="{{ route('workerslist')}}">登録地域のシェフを探す</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
