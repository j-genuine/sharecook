@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-11 my-1">
         <div class="card">
            <div class="card-header"><i class="fas fa-user text-info"></i> {{ $worker->nickname }} さんのプロフィール</div>

            <div class="card-body">
               
                @include('commons.worker_profile_body')
               
               <h5><span class="badge badge-info mt-3">　料理写真　</span></h5>
               
               <div class="row mb-4">
               @foreach ($work_images as $work_image)
                  <div class="col-md-2" style="z-index:2;">
                     <div class="image_expand">{!! $work_image->workImageTag(360,360) !!}</div>
                  </div>
                  <div class="col-md-2 small overflow-auto" style="height:120px; z-index:1; background:#FFFFDD">
                     <i class="far fa-calendar-alt text-info"> {{ substr($work_image->created_at,0,10 ) }}</i><br />
                     {!! nl2br(e($work_image->comment)) !!}
                  </div>
               @endforeach
               @if(!isset($work_image))
                  <div>投稿されている写真がありません。</div>
               @endif
                  <div class="text-right small" style="z-index:1;">
                     {!! $image_page_links !!}
                  </div>
               </div>

         	   <h5 class="my-2 p-2 shadow border text-center">
                  <a class="btn btn-link float-left" href="{{ url('/workerinfo?date=' . $calendar->getPreviousMonth() . '&wid=' . $worker->id) }}"><i class="fas fa-caret-square-left"> 前の月</i></a>
   					<span>{{ $calendar->getTitle() }}の予約状況</span>
   					<a class="btn btn-link float-right" href="{{ url('/workerinfo?date=' . $calendar->getNextMonth() . '&wid=' . $worker->id) }}"><i class="fas fa-caret-square-right"> 次の月</i></a>
               </h5>
               <p>
                  <span class="badge badge-success">ランチ　</span><span class="badge badge-primary">ディナー</span>の表示がある日に予約できます。選択して確認画面にお進みください。<br />
                  <i class="far fa-circle text-primary"></i>：予約ＯＫ <i class="fas fa-times text-danger"></i>：先約済み 
                  @if( !\Auth::user() ) 　（<i class="fas fa-exclamation-circle text-danger">予約するには<a href="/login">ログイン</a>が必要です</i>） @endif
               </p>
            	{!! $calendar->render() !!}


            	<div>
            	   <a href="{{ url('/workerslist') }}" class="btn btn-link"><i class="fas fa-angle-double-right"></i>シェフ一覧へ</a>
               </div>
               
            </div>
         </div>
      </div>
   </div>
</div>
@endsection