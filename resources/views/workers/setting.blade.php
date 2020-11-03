@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ $worker->nickname }}さんのプロフィール設定変更</div>

                <div class="card-body">
                    @if (session('status'))
                       <div class="alert alert-success" role="alert">
                           {{ session('status') }}
                       </div>
                    @endif
                    
                    {{-- エラーメッセージ --}}
                    @include('commons.error_messages')
                    
                    <form method="POST" action="{{ route('workers.setting_update') }}">
                        @csrf

                        <div class="form-group form-row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">プロフィールの公開</label>

                            <div class="col-md-8 form-check form-check-inline">
                                <input id="public_flag1" type="radio" class="form-check-input ml-2" name="public_flag" value="1" @if($worker->public_flag) checked @endif>
                                <label class="form-check-label" for="public_flag1">公開する</label>
                                <input id="public_flag2" type="radio" class="form-check-input ml-2" name="public_flag" value="0" @if(!$worker->public_flag) checked @endif>
                                <label class="form-check-label" for="public_flag2">公開しない</label>
                            </div>
                        </div>
                        
                        <div class="form-group form-row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">名前</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $worker->name }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="nickname" class="col-md-3 col-form-label text-md-right">ニックネーム</label>

                            <div class="col-md-8">
                                <input id="nickname" type="text" class="form-control @error('nickname') is-invalid @enderror" name="nickname" value="{{ $worker->nickname }}" required autocomplete="nickname">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">メールアドレス</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $worker->email }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">パスワード</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="変更する場合は入力(※8文字以上)">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="password-confirm" class="col-md-3 col-form-label text-md-right">パスワード確認</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="パスワード再入力">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="phone" class="col-md-3 col-form-label text-md-right">電話番号</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $worker->phone }}" required autocomplete="phone">
                            </div>
                        </div>
                        
                        <div class="h-adr">
                            <div class="form-group form-row">
                            <label for="area_id" class="col-md-3 col-form-label text-md-right">出張可能エリア</label>

                                <div class="col-md-2">
                                    第1希望:{{Form::select('area_ids[0]', $area_array, $area_ids[0], ['placeholder' => '---', 'class'  => 'form-control', 'required' ])}}
                                </div>
                                <div class="col-md-2">
                                    第2希望:{{Form::select('area_ids[1]', $area_array, $area_ids[1], ['placeholder' => '---', 'class'  => 'form-control' ])}}
                                </div>
                                <div class="col-md-2">
                                    第3希望:{{Form::select('area_ids[2]', $area_array, $area_ids[2], ['placeholder' => '---', 'class'  => 'form-control' ])}}
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="price" class="col-md-3 col-form-label text-md-right">希望謝礼額(￥)</label>

                            <div class="col-md-3">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">ランチ</div>
                                    </div>
                                    <input id="price_lunch" type="text" class="form-control @error('price_lunch') is-invalid @enderror" name="price_lunch" value="{{ $worker->price_lunch }}" autocomplete="price_lunch">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">ディナー</div>
                                    </div>
                                    <input id="price_dinner" type="text" class="form-control @error('price_dinner') is-invalid @enderror" name="price_dinner" value="{{ $worker->price_dinner }}" autocomplete="price_lunch">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group form-row">
                            <label for="career" class="col-md-3 col-form-label text-md-right">料理経験(年数)</label>

                            <div class="col-md-3">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">アマチュア</div>
                                    </div>
                                    <input id="amature_career" type="text" class="form-control @error('amature_career') is-invalid @enderror" name="amature_career" value="{{ $worker->amature_career }}" autocomplete="amature_career">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">プロ</div>
                                    </div>
                                    <input id="pro_career" type="text" class="form-control @error('pro_career') is-invalid @enderror" name="pro_career" value="{{ $worker->pro_career }}" autocomplete="pro_career">
                                </div>
                            </div>
                        </div>
                        
                        <div class="h-adr">
                            <div class="form-group form-row">
                            <label for="skill_id" class="col-md-3 col-form-label text-md-right">得意ジャンル</label>

                                <div class="col-md-2">
                                    1番目:{{Form::select('skill_ids[0]', $skill_array, $skill_ids[0], ['placeholder' => '---', 'class'  => 'form-control', 'required' ])}}
                                </div>
                                <div class="col-md-2">
                                    2番目:{{Form::select('skill_ids[1]', $skill_array, $skill_ids[1], ['placeholder' => '---', 'class'  => 'form-control' ])}}
                                </div>
                                <div class="col-md-2">
                                    3番目:{{Form::select('skill_ids[2]', $skill_array, $skill_ids[2], ['placeholder' => '---', 'class'  => 'form-control' ])}}
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group form-row">
                            <label for="comment" class="col-md-3 col-form-label text-md-right">PRコメント</label>

                            <div class="col-md-8">
                                <textarea id="comment" class="form-control @error('comment') is-invalid @enderror" name="comment" rows="3" autocomplete="comment">{{ $worker->comment }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    　更新　
                                </button>
                                <a href="/workers/home" class="btn btn-secondary">
                                    　マイページにもどる　
                                </a>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('workers.image_store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">■ プロフィール画像変更</div>

                            <div class="card-body">
                                <div class="form-group row">
                                    
                                    
                                    <div class="col-md-4 text-md-center">
                                            {!! $portrait_img_tag !!}
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <input type="file" class="form-control-file" name="image" id="image">
                                        <input type="submit" class="btn btn-primary mt-3" value="画像を変更">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
