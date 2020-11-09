@extends('layouts.app_workers')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">シェフ会員登録</div>

                <div class="card-body">
                    @if (session('status'))
                       <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                    @endif
                    @include('commons.error_messages')
                    
                    <form method="POST" action="{{ route('workers.register') }}">
                        @csrf
                        
                        <div class="text-right small text-primary"><i class="fas fa-asterisk">：必須項目</i></div>
                        <div class="form-group form-row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">名前 <i class="fas fa-asterisk text-primary"></i></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group form-row">
                            <label for="nickname" class="col-md-3 col-form-label text-md-right">ニックネーム <i class="fas fa-asterisk text-primary"></i></label>

                            <div class="col-md-6">
                                <input id="nickname" type="text" class="form-control @error('nickname') is-invalid @enderror" name="nickname" value="{{ old('nickname') }}" required autocomplete="nickname">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">メールアドレス <i class="fas fa-asterisk text-primary"></i></label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                        </div>

                         <div class="form-group form-row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">パスワード <i class="fas fa-asterisk text-primary"></i></label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="password-confirm" class="col-md-3 col-form-label text-md-right">パスワード確認 <i class="fas fa-asterisk text-primary"></i></label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" required placeholder="パスワード再入力">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="phone" class="col-md-3 col-form-label text-md-right">電話番号 <i class="fas fa-asterisk text-primary"></i></label>

                            <div class="col-md-4">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                            </div>
                        </div>
                        
                        <div class="h-adr">
                            <div class="form-group form-row">
                            <label for="area_id" class="col-md-3 col-form-label text-md-right">出張可能エリア</label>

                                <div class="col-md-2">
                                    <span class="badge badge-pill badge-secondary">第１希望</span>{{Form::select('area_ids[0]', $area_array, old('area_ids[0]'), ['placeholder' => '---', 'class'  => 'form-control' ])}}
                                </div>
                                <div class="col-md-2">
                                    <span class="badge badge-pill badge-secondary">第２希望</span>{{Form::select('area_ids[1]', $area_array, old('area_ids[1]'), ['placeholder' => '---', 'class'  => 'form-control' ])}}
                                </div>
                                <div class="col-md-2">
                                    <span class="badge badge-pill badge-secondary">第３希望</span>{{Form::select('area_ids[2]', $area_array, old('area_ids[2]'), ['placeholder' => '---', 'class'  => 'form-control' ])}}
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
                                    <input id="price_lunch" type="text" class="form-control @error('price_lunch') is-invalid @enderror" name="price_lunch" value="{{ old('price_lunch') }}" autocomplete="price_lunch">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">ディナー</div>
                                    </div>
                                    <input id="price_dinner" type="text" class="form-control @error('price_dinner') is-invalid @enderror" name="price_dinner" value="{{ old('price_dinner') }}" autocomplete="price_lunch">
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
                                    <input id="amature_career" type="text" class="form-control @error('amature_career') is-invalid @enderror" name="amature_career" value="{{ old('amature_career') }}" autocomplete="amature_career">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">プロ</div>
                                    </div>
                                    <input id="pro_career" type="text" class="form-control @error('pro_career') is-invalid @enderror" name="pro_career" value="{{ old('pro_career') }}" autocomplete="pro_career">
                                </div>
                            </div>
                        </div>
                        
                        <div class="h-adr">
                            <div class="form-group form-row">
                            <label for="skill_id" class="col-md-3 col-form-label text-md-right">得意ジャンル</label>

                                <div class="col-md-2">
                                    <span class="badge badge-pill badge-secondary">１番目</span>{{Form::select('skill_ids[0]', $skill_array, old('skill_ids[0]'), ['placeholder' => '---', 'class'  => 'form-control' ])}}
                                </div>
                                <div class="col-md-2">
                                    <span class="badge badge-pill badge-secondary">２番目</span>{{Form::select('skill_ids[1]', $skill_array, old('skill_ids[1]'), ['placeholder' => '---', 'class'  => 'form-control' ])}}
                                </div>
                                <div class="col-md-2">
                                    <span class="badge badge-pill badge-secondary">３番目</span>{{Form::select('skill_ids[2]', $skill_array, old('skill_ids[2]'), ['placeholder' => '---', 'class'  => 'form-control' ])}}
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="comment" class="col-md-3 col-form-label text-md-right">PRコメント</label>

                            <div class="col-md-8">
                                <textarea id="comment" class="form-control @error('comment') is-invalid @enderror" name="comment" rows="3" autocomplete="comment">{{ old('comment') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    　登録　
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
