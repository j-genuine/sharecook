@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="topview container-fluid p-0">
            <div class="row" style="border-bottom:4px #FF6633 solid;">
                <img src="images/top_01.jpg" class="img-fluid top_pc">
                <img src="images/top_s.jpg" class="img-fluid top_sp">
            </div>
            <div class="row">
                
                <div class="top_box1 col-md-6 p-3 text-center font-weight-bold">
                    シェアクックは、料理を作りたい人と<br />
                    作って欲しい人をマッチングするサービスです<br />
                    <a href="register" class="btn btn-outline-danger" role="button"><i class="fas fa-drumstick-bite"> 料理を作ってほしい方【利用登録】</i></a>
                </div>
                <div class="top_box2 col-md-6 p-3 text-center font-weight-bold">
                    <small>腕を活かして、おこづかい稼ぎしましょう！</small><br/>
                    <a href="workers/register" class="btn btn-success" role="button"><i class="fas fa-fish"> 料理を作りたい方【シェフ登録】</i></a><br />
                    [<a href="workers/login" class="btn btn-link font-weight-bold">シェフ会員ログイン (登録済みの方)</a>]
                </div>
            </div>
            <div class="row p-2" style="background-color:#FF6633; color:#FFF;">
                <span><i class="fas fa-utensils"></i> こんなシェフたちに、あなたの家で料理を作ってもらいませんか？　<a href="/workerslist" class="btn btn-light btn-sm"><i class="fas fa-angle-double-right"></i> もっと探す</a></span>
            </div>

            @include('commons.workers_list_body')

        </div>
    </div>
</div>
@endsection
