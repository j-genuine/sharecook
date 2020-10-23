@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header text-center">
   					<a class="btn btn-outline-secondary float-left" href="{{ url('/workerinfo?date=' . $calendar->getPreviousMonth() . '&wid=' . $worker_id) }}">前の月</a>
   					<span>{{ $calendar->getTitle() }}</span>
   					<a class="btn btn-outline-secondary float-right" href="{{ url('/workerinfo?date=' . $calendar->getNextMonth() . '&wid=' . $worker_id) }}">次の月</a>
					</div>
               <div class="card-body">
               {!! $prefix = Request::route()->getPrefix() !!}
					{!! $calendar->render() !!}
               </div>
           </div>
       </div>
   </div>
</div>
@endsection