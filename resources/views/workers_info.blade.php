@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
         <div class="card-header">{{ $worker->nickname }}さんのプロフィールと予約状況</div>

            <div class="card-body">
              <ul>
                  <li>ニックネーム：{{ $worker->nickname }}</li>
                  <li>ランチ：{{ $worker->price_lunch }}</li>
                  <li>ディナー：{{ $worker->price_dinner }}</li>
              </ul>

            <div class="card">
               <div class="card-header text-center">
            		<a class="btn btn-outline-secondary float-left" href="{{ url('/workerinfo?date=' . $calendar->getPreviousMonth() . '&wid=' . $worker->id) }}">前の月</a>
            		<span>{{ $calendar->getTitle() }}</span>
            		<a class="btn btn-outline-secondary float-right" href="{{ url('/workerinfo?date=' . $calendar->getNextMonth() . '&wid=' . $worker->id) }}">次の月</a>
            	</div>
               <div class="card-body">
            	{!! $calendar->render() !!}
            	</div>
            </div>
         	<div>
         	⇒<a href="{{ url('/workerslist?page=1' ) }}">シェフ一覧にもどる</a>
            </div>

       </div>
   </div>
</div>
@endsection