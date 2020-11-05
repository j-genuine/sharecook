@extends('layouts.app_workers')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-10">
         <div class="card">
            
            <div class="card-header">
               {{ $worker->nickname }}さんの料理画像編集
            </div>
            <div class="card-body">
               {{-- ステータス／エラーメッセージ --}}
               @if (session('status'))
                 <div class="alert alert-success" role="alert">{{ session('status') }}</div>
               @endif
               @include('commons.error_messages')

               
               <div class="form-group form-row">
                  <div class="col-md-4 text-md-center">
                     {!! $work_image->workImageTag() !!}
                  </div>
                  <div class="col-md-8">
                     {!! Form::open(['route' => ['workers.work_images.update', $work_image->id], 'method' => 'put']) !!}
                     <ul>
                        <li>登録日時：{{ $work_image->created_at }}</li>
                        <li>コメント：<br />
                           {!! Form::textarea('comment', $work_image->comment, ['rows' => '2', 'maxlength' => '500', 'placeholder' => 'コメント (料理名や出来栄え等を入力)', 'class' => 'form-control mt-2']) !!}
                        </li>
                     </ul>
                     <div style="display:flex">
                         {!! Form::submit('　更新　', ['class' => 'btn btn-primary mt-2 ml-4']) !!}
                         {!! Form::close() !!}
                         {!! Form::open(['route' => ['workers.work_images.destroy', $work_image->id], 'method' => 'delete']) !!}
                         {!! Form::submit('　この画像を削除　', ['class' => 'btn btn-danger mt-2 ml-2']) !!}
                         {!! Form::close() !!}
                      </div>
                  </div>
               </div>
               

                <a href="{{ route('workers.work_images.index') }}" class="btn btn-link"><i class="fas fa-angle-double-right"></i>料理画像一覧にもどる</a><br />
            </div>
            
         </div>
      </div>
   </div>
</div>
@endsection