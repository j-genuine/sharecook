@extends('layouts.app_workers')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ $worker->nickname }}さんのシェフ会員退会</div>

                <div class="card-body">
                    @if (session('status'))
                       <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                    @endif
                    @include('commons.error_messages')
                  
                    <form method="POST" action="{{ route('workers.destroy') }}">
                        @method('DELETE')
                        @csrf
                    
                        <h5 class="px-4 text-danger"><i class="fas fa-exclamation-triangle"> 本当にシェフ会員を退会しますか？</i></h5>
                        <div class="row m-4">
                            <ul>
                            <li>退会すると、料理画像他、全ての登録情報が完全に削除されます。削除されたデータは二度と復旧できません。</li>
                            <li>上記を了承の上で本当に退会される場合は、下記に登録メールアドレスを入力の上、退会ボタンを押してください。</li>
                            </ul>
                        </div>

                        <div class="form-group form-row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">メールアドレス</label>

                            <div class="col-md-8">
                                <input id="check_str" type="email" class="form-control @error('check_str') is-invalid @enderror" name="check_str" value="" required>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    本当に退会する
                                </button>
                                <a href="{{ route('workers.setting') }}" class="btn btn-primary"><i class="fas fa-angle-double-right"></i>プロフィール設定に戻る</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
