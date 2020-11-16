@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">新規利用登録</div>

                <div class="card-body">
                    <div class="row p-3 mb-2" style="background:#FFEEDD;color:#630;">
                        <div class="col-md-4 text-center"><img src="/images/cuisine_1.jpg"></div>
                        <div class="col-md-8">
                            いつもと違う手料理をあなたの家で！<br/>
                            お気に入りのシェフを見つけたら、下記の情報を入力の上、利用登録してください。<br/>
                            <div class="text-right">
                                <a href="workers/register" class="btn btn-link"><i class="fas fa-angle-double-right"></i> シェフとして会員登録したい方はこちら</a>
                            </div>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">名前</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">パスワード確認</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">電話番号</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>

                        <div class="h-adr">
                            <div class="form-group form-row">
                            <label for="area_id" class="col-md-4 col-form-label text-md-right">住所</label>


                                <span class="p-country-name" style="display:none;">Japan</span>
                                
                                <div class="col-md-3">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">〒</div>
                                        </div>
                                        <input id="zip_cd" name="zip_cd" type="text" class="p-postal-code form-control" size="8" maxlength="8" required value="{{ old('zip_cd') }}"><br>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::select('area_id', App\Area::get()->pluck("name","id"), '', ['placeholder' => '-自動選択-', 'class'  => 'p-region-id  form-control', 'required' ])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-6">
                                <input type="text" id="address" name="address" class="p-locality p-street-address p-extended-address form-control" required value="{{ old('address') }}" placeholder="市区町村以下"/><br>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    　利用登録　
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
