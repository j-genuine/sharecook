@extends('layouts.app_workers')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">【シェフ会員】 {{ $worker->nickname }}さんのマイページ</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul>
                        <li>お名前：{{ $worker->name }}</li>
                        <li>ニックネーム：{{ $worker->nickname }}</li>
                        <li>メール：{{ $worker->email }}</li>
                        <li>電話番号：{{ $worker->phone }}</li>
                    </ul>
                    ⇒<a href="{{ route('workers.schedule_edit') }}">スケジュールの確認・登録</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
