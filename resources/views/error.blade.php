@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header alert">エラー</div>

                <div class="card-body">
                    {{ $message }}
                    <div class="mt-5">
                        ⇒ <a href="
                    @if ($return_url)
                        {{ $return_url }}
                    @else
                        /
                    @endif
                        ">もどる</a></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
