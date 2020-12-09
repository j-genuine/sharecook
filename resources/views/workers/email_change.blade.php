@extends('layouts.app_workers')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card">
                <div class="card-header">メールアドレス変更</div>

                <div class="card-body">
                    @if (session('status'))
                       <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                    @endif
                    @include('commons.error_messages')
                    
                    <p class="m-4 text-center">
                        登録メールアドレスを変更する場合、まずは<srtong>新しいメールアドレス</strong>を下記フォームからご送信ください。<br/>
                        登録を完了するためのURLを、新しいアドレスに自動返信します。
                    </p>
                    <form method="POST" action="{{ route('workers.email_temp_update') }}">
                        @csrf
                        
                        <div class="form-group form-row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">メールアドレス</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    メールアドレスを送信 
                                </button>
                                <a href="{{ route('workers.setting') }}" class="btn btn-link"><i class="fas fa-angle-double-right"></i>プロフィール設定にもどる</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
