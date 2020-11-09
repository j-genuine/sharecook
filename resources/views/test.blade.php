@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
 
        <div class="container-fluid" style="background-color:#FFFFDD;">
            <div class="mx-auto" style="width:960px;"><img src="images/top.jpg"></div>
            <div class="row" style="border-top:5px #FF6633 solid;">
                <div class="col-md-6 p-3 text-center" style="background-color:#FFDDAA;">
                    シェアクックは、料理を作りたい人と<br />
                    作って欲しい人をマッチングするサービスです。
                </div>
                <div class="col-md-6 p-3 text-center" style="background-color:#DDFFDD;">
                    <a href="#" class="btn btn-outline-success btn-lg active" role="button">料理を作りたい方【シェフ登録】</a><br />
                    [ <a href="">シェフ会員ログイン</a> ]
                </div>
            </div>
            <div class="row p-2" style="background-color:#FF6633; color:#FFF;">
                ■ こんなシェフたちに、あなたの家で料理を作ってもらいませんか？　【<a href="#">もっと探す</a>】
            </div>
            <div class="row p-2" style="background-color:#FFFFDD;">
                <div class="col p-3 m-2 text-center" style="background-color:#FFF;border:2px #99FF66 dotted">
                    <div class="row">
                        <div class="col-md-3 text-md-center my-auto">
                            <img src="/images/portrait_dummy.png" width="80" height=80 />
                        </div>
                        <div class="col-md-6 text-md-center">
                            <table class="profile_s">
                                <tr>
                                    <td colspan="2">
                                    シェフ２
                                    </td>
                                </tr>
                                <tr>
                                    <th>エリア：</th>
                                    <td>
                                    大阪府／京都府 
                                    </td>
                                </tr>
                                <tr>
                                    <th>ジャンル：</th>
                                    <td>
                                    和食／スイーツ 
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-2 text-md-center my-auto">
                            <img src="/images/portrait_dummy.png" width="60" height=60 />
                        </div>
                    </div>
                </div>
                    
                <div class="col p-3 m-2 text-center" style="background-color:#FFF">
                    aaaa
                    
                </div>
            </div>
        </div>
        <footer style="background-color:gray">Footer</footer>
    </div>
</div>
@endsection
