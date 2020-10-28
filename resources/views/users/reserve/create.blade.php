@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
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
                  <div class="card-header">
                     シェフのプロフィール
               	</div>
                  <div class="card-body">
                     <ul>
                        <li>ニックネーム：{{ $worker->nickname }}</li>
                        <li>ランチ：{{ $worker->price_lunch }}</li>
                        <li>ディナー：{{ $worker->price_dinner }}</li>
                     </ul>
               	</div>
               </div>
               ⇒<a href="/workerinfo?wid={{ $worker->id }}">スケジュールを選びなおす</a><br />
               <br />
               {!! Form::hidden('price', $price) !!}
               {!! Form::hidden('worker_schedule_id', $worker_schedule->id) !!}
               {!! Form::submit('■　予約を確定する　■', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
         </div>
      </div>
   </div>
</div>
@endsection