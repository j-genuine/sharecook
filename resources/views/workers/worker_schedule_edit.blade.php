@extends('layouts.app_workers')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header text-center">
   					<a class="btn btn-outline-secondary float-left" href="{{ url('/workers/schedule_edit?date=' . $calendar->getPreviousMonth()) }}">前の月</a>
   					<span>{{ $calendar->getTitle() }}の出張可能日設定</span>
   					<a class="btn btn-outline-secondary float-right" href="{{ url('/workers/schedule_edit?date=' . $calendar->getNextMonth()) }}">次の月</a>
   				</div>
               <div class="card-body">
					@if (session('status'))
                       <div class="alert alert-success" role="alert">
                           {{ session('status') }}
                       </div>
                   @endif
					<form method="post" action="{{ route('workers.schedule_update') }}">
						@csrf
						<div class="card-body">
							{!! $calendar->render() !!}
							<div class="text-center">
								<button type="submit" class="btn btn-primary">保存</button>
							</div>
						</div>
						
					</form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection