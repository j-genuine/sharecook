@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-11">
         <div class="card">
            {!! Form::open(['route' => ['users.reserve.destroy', $user_reservation->id], 'method' => 'delete']) !!}
            <div class="card-header">
               シェフ出張予約キャンセル
            </div>
            <div class="card-body">
               @if (session('status'))
                  <div class="alert alert-success" role="alert">{{ session('status') }}</div>
               @endif
               @include('commons.error_messages')

               <h5 class="text-danger">本当に下記の予約をキャンセルしますか？</h5>
               <ul>
                     <li>予約日：{{ $date_str }} 【{{$meal_type_str}}】 <small>{{ $worker_schedule->comment }}</small></li>
                     <li>謝礼額：{{ $price_str }}</li>
                     <li>来宅の希望時間：{{ $visit_time_str }}</li>
                     <li>メッセージ：{{ $user_reservation->message }}</li>
               </ul>

               <div class="card">
                  <div class="card-header"><i class="fas fa-smile text-info">シェフ：</i> {{ $worker->nickname }} さん</div>
                  <div class="card-body">
                     
                     @include('commons.worker_profile_body')
                     
               	</div>
               </div>
               <br />
               <div class="form-group">
               {!! Form::label('cancel_reason', 'キャンセル理由') !!}：
               {!! Form::textarea('cancel_reason', old('cancel_reason'), ['rows' => '3', 'maxlength' => '300', 'placeholder' => 'キャンセルされる理由を入力してください。（*シェフに通知されます）', 'class' => 'form-control', 'required' => 'required']) !!}
               </div>
               {!! Form::hidden('worker_schedule_id', $worker_schedule->id) !!}
               {!! Form::hidden('date', $date_str) !!}
               {!! Form::hidden('visit_time_str', $visit_time_str) !!}
               {!! Form::hidden('message', $user_reservation->message) !!}
               <a href="/home" class="btn btn-secondary">キャンセルしない</a>
               {!! Form::submit('■　予約キャンセルを実行する　■', ['class' => 'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}
         </div>
      </div>
   </div>
</div>
@endsection