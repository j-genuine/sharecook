@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-10 my-1">
         <div class="card">
            <div class="card-header">■ お問い合わせ</div>

            <div class="card-body px-4">
               @if (session('status'))
                 <div class="alert alert-success" role="alert">{{ session('status') }}</div>
               @endif
               @include('commons.error_messages')
               <div class="alert alert-danger" role="alert">
                  <h5>当サイトはデモンストレーション用に試験公開中です。</h5>
                  <p>
                     サービス内容や運営等に関するお問い合わせにはお答えしかねますので、ご了承ください。<br/>
                  </p>
               </div>
               
               <p>
                  当サービスについてのお問い合わせは、下記のフォームよりご連絡ください。
               </p>
               <form method="POST" action="{{ route('inquiry') }}">
                  @csrf
               
                  <div class="form-group form-row">
                      <label for="name" class="col-md-3 col-form-label text-md-right">お名前</label>
               
                      <div class="col-md-6">
                          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                      </div>
                  </div>
               
                  <div class="form-group form-row">
                      <label for="email" class="col-md-3 col-form-label text-md-right">メールアドレス</label>
               
                      <div class="col-md-8">
                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                          <small>* 会員登録されている方は、登録されているメールアドレスをご入力ください。</small>
                      </div>
                  </div>

                  <div class="form-group form-row">
                     <label for="category" class="col-md-3 col-form-label text-md-right">ご用件</label>
                     
                     <div class="col-md-6">
                        <select id="category" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}" required>
                           <option value="">---以下からお選びください---</option>
                           <option value="サービス内容">サービス内容について</option>
                           <option value="シェフ会員">シェフ会員について</option>
                           <option value="事業・協業">協業や事業内容について</option>
                           <option value="その他">その他</option>
                        </select>
                     </div>
                  </div>

                  <div class="form-group form-row">
                      <label for="message" class="col-md-3 col-form-label text-md-right">メッセージ</label>
               
                      <div class="col-md-8">
                          <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" rows="8" autocomplete="message" required>{{ old('message') }}</textarea>
                      </div>
                  </div>
               
                  <div class="form-group row mb-2">
                      <div class="col-md-6 offset-md-4">
                          <button type="submit" class="btn btn-primary">
                              上記内容で送信する
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