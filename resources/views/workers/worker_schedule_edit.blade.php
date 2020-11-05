@extends('layouts.app_workers')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-10">
           <div class="card">
               <div class="card-header">{{ $worker->nickname }}さんのスケジュール登録</div>
               <div class="card-body">
                  <p>
                     出張可能な日にチェックを入れ、保存ボタンを押してください。<br />
                     一行メモ欄にコメントを入力できます。【例：19時以降OK】
                  </p>
                  <h5 class="my-2 p-2 shadow border text-center">
                     <a class="btn btn-link float-left" href="{{ url('/workers/schedule_edit?date=' . $calendar->getPreviousMonth()) }}"><i class="fas fa-caret-square-left"> 前の月</i></a>
      					<span>{{ $calendar->getTitle() }}の出張可能日設定</span>
      					<a class="btn btn-link float-right" href="{{ url('/workers/schedule_edit?date=' . $calendar->getNextMonth()) }}"><i class="fas fa-caret-square-right"> 次の月</i></a>
                  </h5>
                     
   					@if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif
   					<form method="post" action="{{ route('workers.schedule_update') }}">
   						@csrf
   						<div class="card-body">
   							{!! $calendar->render() !!}
   							<div class="text-left">
   							   ※<i class="fas fa-clock"></i>は予約済みのため変更できません。
   							</div>
   							<div class="text-center">
   								<button type="submit" class="btn btn-primary">■　保存　■</button>
   							</div>
   						</div>
   						
   					</form>
   					<a href="{{ route('workers.workers_home') }}" class="btn btn-link"><i class="fas fa-angle-double-right"></i>マイページにもどる</a><br />
               </div>
           </div>
       </div>
   </div>
</div>
@endsection