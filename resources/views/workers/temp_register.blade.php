@extends('layouts.app_workers')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card">
                <div class="card-header">シェフ会員登録</div>

                <div class="card-body">
                    <div class="row p-3" style="background:#FFFFEE;color:#990;">
                        <div class="col-md-4 text-center"><img src="/images/chef_1.jpg"></div>
                        <div class="col-md-8">
                            あなたの時間を少しだけ使って、誰かのために、料理を作ってみませんか？<br/>
                            謝礼と、そしてたくさんの笑顔がもらえます。<br/>
                            <br/>
                            料理人としての経験が無くても、情熱のある方ならどなたでも登録OKです。
                        </div>
                    </div>
                    
                    @if (session('status'))
                       <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                    @endif
                    @include('commons.error_messages')
                    
                    <form method="POST" action="{{ route('workers.temp_store') }}">
                        @csrf
                        
                        <div class="form-group form-row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">メールアドレス <i class="fas fa-asterisk text-primary"></i></label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    　登録メールを送信
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
