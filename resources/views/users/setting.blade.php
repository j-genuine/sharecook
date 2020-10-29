@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">ユーザー登録内容変更</div>

                <div class="card-body">
                    @if (session('status'))
                       <div class="alert alert-success" role="alert">
                           {{ session('status') }}
                       </div>
                    @endif
                    
                    {{-- エラーメッセージ --}}
                    @include('commons.error_messages')
                    
                    <form method="POST" action="{{ route('users.setting_update') }}">
                        @csrf

                        <div class="form-group form-row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">名前</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">メールアドレス</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
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
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="phone">
                            </div>
                        </div>
                        
                        <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>

                        <div class="h-adr">
                            <div class="form-group form-row">
                            <label for="area_id" class="col-md-3 col-form-label text-md-right">住所</label>


                                <span class="p-country-name" style="display:none;">Japan</span>
                                
                                <div class="col-md-3">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">〒</div>
                                        </div>
                                        <input id="zip_cd" name="zip_cd" type="text" class="p-postal-code form-control @error('zip_cd') is-invalid @enderror" maxlength="8" required value="{{ $user->zip_cd }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{Form::select('area_id', App\Area::get()->pluck("name","id"), $user->area_id, ['placeholder' => '-自動選択-', 'class'  => 'p-region-id  form-control', 'required' ])}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="address" name="address" class="p-locality p-street-address p-extended-address form-control @error('address') is-invalid @enderror" required value="{{ $user->address }}" placeholder="市区町村以下"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    　更新　
                                </button>
                                <a href="/home" class="btn btn-secondary">
                                    　マイページにもどる　
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
