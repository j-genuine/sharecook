ShareCOOK お問い合わせフォームから連絡がありました。

名前：{{ $request->name }} 様
メール：{{ $request->email }}
用件：{{ $request->category }}
メッセージ：
{{ $request->message }}

~~~~~~~~~~~~~~~~~~
送信日時：{{ date( "Y/m/d (D) H:i:s", time() ) }}
送信者IPアドレス{{ @$_SERVER["REMOTE_ADDR"] }}