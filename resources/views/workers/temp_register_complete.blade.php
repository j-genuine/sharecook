@extends('layouts.app_workers')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">シェフ会員登録メール送信完了</div>

                <div class="card-body">

                    <h5>会員登録メールの送信が完了しました。</h5>
                    <p class="m-4">
                        メールに記載されたURLより、シェフ会員の本登録を行ってください。<br/>
                        * メール送信後24時間以内にご登録ください。（<a href="/workers/temp_register">再送信はこちら</a>）
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
