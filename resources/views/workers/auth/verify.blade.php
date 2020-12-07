@extends('layouts.app_workers')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            新しい本登録メールが送信されました。
                        </div>
                    @endif

                    <p>
                        ご入力頂いたメールアドレスに本登録メールをお送りしました。<br/>
                        記載されたURLをクリックして登録を完了してください。
                    </p>
                    <p>メールが届いていない場合下記ボタンをクリックしてください。</p>
                    <form class="d-inline" method="POST" action="{{ route('workers.verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">確認メールを再発行</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
