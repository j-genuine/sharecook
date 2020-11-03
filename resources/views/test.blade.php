@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header alert">テスト</div>

                <div class="card-body">

                <form action="{{ route('test_post') }}" method="post" enctype="multipart/form-data">
                <!-- アップロードフォームの作成 -->
                @csrf
                <input type="file" name="image">
                <input type="submit" value="アップロード">
                </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
