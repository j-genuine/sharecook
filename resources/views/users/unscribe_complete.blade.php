@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">退会処理完了</div>

                <div class="card-body">

                    <h5>退会処理が完了しました。</h5>
                    <p class="m-4">
                        ShareCOOKをご利用いただき、ありがとうございました。<br/>
                        またのご利用をお待ちしております。
                    </p>

                    <div class="text-center m-2">
                        <a href="/" class="btn btn-primary"><i class="fas fa-angle-double-right"></i>トップページへ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
