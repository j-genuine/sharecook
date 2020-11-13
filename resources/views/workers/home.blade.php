@extends('layouts.app_workers')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">【シェフ会員】 {{ $worker->nickname }}さんのマイページ</div>

                <div class="card-body">
                    {{-- ステータス／エラーメッセージ --}}
                    @if (session('status'))
                     <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                    @endif
                    @include('commons.error_messages')

                    <h5 class="my-1 p-2 border shadow">■ 現在の予約受付状況</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>日付</th>
                                <th>区分/希望時間</th>
                                <th>謝礼額</th>
                                <th>クライアント情報</th>
                                <th>メッセージ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$reservations)
                            <tr><td colspan="5">現在、受付済みの予約はありません。</td></tr>
                            @endif
            
                            @foreach ($reservations as $key => $reservation)
                            <tr>
                                <td>{{ $reservation['date_str'] }}</td>
                                <td>
                                    {{ $reservation['meal_type'] }}<br />
                                    {{ $reservation['visit_time_str'] }}
                                </td>
                                <td>{{ $reservation['price_str'] }}</td>
                                <td>
                                    <span class="font-weight-bold">{{ $reservation['user_name'] }}</span> 様<br />
                                    [住所] {{ $reservation['user_address'] }}<br />
                                    [電話] {{ $reservation['user_phone'] }}<br />
                                </td>
                                <td>{{ $reservation['message'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $reserve_pagelinks !!}
                    <div class="text-center">
                    <a href="{{ route('workers.schedule_edit') }}" class="btn btn-info"><i class="fas fa-angle-double-right"></i>スケジュールの確認・登録</a>
                    </div>
                    
                    <h5 class="my-3 p-2 border shadow">■ プロフィール設定 [ <a href="{{ route('workers.setting') }}"> 
                        @if($worker->public_flag) <span class="font-weight-bold">公開中</span> @else 非公開 @endif </a> ] 
                        <small class="form-check-input ml-3">※★の項目が公開対象</small>
                    </h5>
                    <div class="row">
                        
                        <div class="col-md-3 text-md-center my-auto">
                            {!! $worker->portraitImageTag() !!}
                            <div>プロフィール画像</div>
                        </div>
                        
                        <div class="col-md-9 text-md-center">
                            <table class="profile">
                                <tr>
                                    <th>お名前：</th>
                                    <td>
                                    {{ $worker->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>★ニックネーム：</th>
                                    <td>
                                    {{ $worker->nickname }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>メール：</th>
                                    <td>
                                    {{ $worker->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>電話番号：</th>
                                    <td>
                                    {{ $worker->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>★出張可能エリア：</th>
                                    <td>
                                    {{ $worker_area_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>★希望謝礼額：</th>
                                    <td>
                                    [ランチ] ￥{{ number_format($worker->price_lunch) }} [ディナー] ￥{{ number_format($worker->price_dinner) }} 
                                    </td>
                                </tr>
                                <tr>
                                    <th>★料理経験：</th>
                                    <td>
                                    [アマチュア] {{ $worker->amature_career }}年 [プロ] {{ $worker->pro_career }}年 
                                    </td>
                                </tr>
                                <tr>
                                    <th>★得意ジャンル：</th>
                                    <td>
                                    {{ $worker_skill_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                     <div class="font-weight-bold">【PRコメント】</div>
                                     {{ $worker->comment }}
                                    </td>
                                </tr>
                            </table>

                        </div>

                    </div>
                    <div class="text-center">
                        <a href="{{ route('workers.setting') }}" class="btn btn-info"><i class="fas fa-angle-double-right"></i>プロフィール設定変更</a>
                    </div>
 
                    <h5 class="my-3 p-2 border shadow">■ 料理画像設定</h5>

                    <div class="text-center">
                        <p>
                            現在 {{ $worker->workImages()->count() }}枚の画像が保存されています。
                        </p>
                        <a href="{{ route('workers.work_images.index') }}" class="btn btn-info"><i class="fas fa-angle-double-right"></i>料理画像の登録・変更</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
