@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">

      <div class="container-fluid my-3" style="background-color:#FFFFDD;">
         <div class="p-2" style="background-color:#FF6633; color:#FFF;">
             ■ お気に入りのシェフを見つけて、予約しましょう。
             {!! Form::open(['route' => 'workerslist', 'method' => 'get']) !!}
             <div class="form-group form-row ml-3">
                  <label for="name" class="col-md3 col-form-label">地域：</label>
                  <div class="col-md3">
                     {{Form::select('area_id', App\Area::get()->pluck("name","id"), $area_id, ['placeholder' => '--全て--', 'class'  => 'form-control'])}}
                  </div>
                  <label for="name" class="col-md3 col-form-label text-md-right">得意ジャンル：</label>
                  <div class="col-md3">
                     {{Form::select('skill_id', App\Skill::get()->pluck("name","id"), $skill_id, ['placeholder' => '--全て--', 'class'  => 'form-control'])}}
                  </div>
                  <div class="col-md3">
                     {!! Form::submit('検索', ['class' => 'btn btn-light']) !!}
                  </div>
             </div>
             {!! Form::close() !!}
         </div>
      
       @include('commons.workers_list_body')
       
       {{ $workers->links() }}
      </div>
   </div>
</div>
@endsection