@extends('layouts.app_workers')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-10">
         <div class="card">
            
            <div class="card-header">
               {{ $worker->nickname }}さんの料理画像
            </div>
            <div class="card-body">
               {{-- ステータス／エラーメッセージ --}}
               @if (session('status'))
                 <div class="alert alert-success" role="alert">{{ session('status') }}</div>
               @endif
               @include('commons.error_messages')

               {!! Form::open(['route' => 'workers.work_images.store', 'enctype' => 'multipart/form-data']) !!}
               <div class="form-group form-row">
                  {!! Form::label('image', '料理画像を追加', ['class'=>'col-md-3 col-form-label text-md-right']) !!}
                  <div class="col-md-8">
                      {{ Form::file('image', ['class'=>'form-control-file']) }}
                      {!! Form::textarea('comment', old('comment'), ['rows' => '2', 'maxlength' => '500', 'placeholder' => 'コメント (料理名や出来栄え等を入力)', 'class' => 'form-control mt-2']) !!}
                      {!! Form::submit('■　追加　■', ['class' => 'btn btn-primary mt-2']) !!}
                  </div>
               </div>
               {!! Form::close() !!}

               <h5>【現在登録されている画像】</h5>
               <table class="table table-striped">
                  @foreach ($work_images as $work_image)
                  <tr>
                     <td class="text-md-center">{!! $work_image->workImageTag() !!}</td>
                     <td>
                        <ul>
                           <li>登録日：{{ $work_image->created_at }}</li>
                           <li>コメント：<br />
                              {!! nl2br(e($work_image->comment)) !!}
                           </li>
                        </ul>
                         <a href="{{ route('workers.work_images.edit',$work_image->id) }}" class="btn btn-link"><i class="fas fa-edit"></i>変更する</a><br />
                     </td>
                  </tr>
                  @endforeach
               </table>
               @if(!isset($work_image))
               <div class="text-center">登録されている画像がありません。画像を追加して、自慢の手料理をアピールしましょう！</div>
               @endif

               {{ $work_images->links() }}

               <a href="{{ route('workers.workers_home') }}" class="btn btn-link"><i class="fas fa-angle-double-right"></i>マイページにもどる</a><br />
            </div>
            
         </div>
      </div>
   </div>
</div>
@endsection