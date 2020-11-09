@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
 
        <div class="container-fluid" style="background-color:#FFFFDD;">
            <div class="mx-auto" style="width:960px;"><img src="images/top.jpg"></div>
            <div class="row" style="border-top:4px #FF6633 solid;">
                <div class="col-md-6 p-3 text-center" style="background-color:#FFDDAA;color:#093;">
                    シェアクックは、料理を作りたい人と<br />
                    作って欲しい人をマッチングするサービスです<br />
                    <a href="register" class="btn btn-outline-danger" role="button">さっそくシェフに来てもらう</a>
                </div>
                <div class="col-md-6 p-3 text-center" style="background-color:#DDFFDD;">
                    <a href="workers/register" class="btn btn-success" role="button">料理を作りたい方【シェフ登録】</a><br />
                    [ <a href="workers/login">シェフ会員ログイン</a> ]
                </div>
            </div>
            <div class="row p-2" style="background-color:#FF6633; color:#FFF;">
                ■ こんなシェフたちに、あなたの家で料理を作ってもらいませんか？　<a href="/workerslist" class="btn btn-light btn-sm">もっと探す</a>
            </div>

            @include('commons.workers_list_body')

        </div>
    </div>
</div>
@endsection
