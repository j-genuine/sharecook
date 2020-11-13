@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-11">
         <div class="card">
            {!! Form::open(['route' => 'users.reserve.store']) !!}
            <div class="card-header">
               シェフ出張予約確認
            </div>
            <div class="card-body">
               <ul>
                     <li>予約日：{{ $date_str }} 【{{$meal_type_str}}】 <small>{{ $worker_schedule->comment }}</small></li>
                     <li>謝礼額：{{ $price_str }}</li>
                     <li class="form-group">
                        {!! Form::label('visit_time', '来宅の希望時間') !!}：
                        {!! Form::select('visit_time', $visit_time, old('visit_time'), ['placeholder' => '(時間指定無し)', 'class' => 'form-control']) !!}
                     </li>
                     <li class="form-group">
                        {!! Form::label('visit_time', 'メッセージ') !!}：
                        {!! Form::textarea('message', old('message'), ['rows' => '3', 'maxlength' => '300', 'placeholder' => '人数や希望レシピ、用意できる食材等を入力', 'class' => 'form-control']) !!}
                     </li>
               </ul>

               <div class="card">
                  <div class="card-header"><i class="fas fa-smile text-info">シェフ：</i> {{ $worker->nickname }} さん</div>
                  <div class="card-body">
                     
                     @include('commons.worker_profile_body')
                     
               	</div>
               </div>
               <br />
               {!! Form::hidden('price', $price) !!}
               {!! Form::hidden('worker_schedule_id', $worker_schedule->id) !!}
               {!! Form::submit('■　予約を確定する　■', ['class' => 'btn btn-primary']) !!}
               <a href="/workerinfo?wid={{ $worker->id }}" class="btn btn-link"><i class="fas fa-angle-double-right"></i> スケジュールを選びなおす</a>
            </div>
            {!! Form::close() !!}
         </div>
      </div>
   </div>
</div>
@endsection