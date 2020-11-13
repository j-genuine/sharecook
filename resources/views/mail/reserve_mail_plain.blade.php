****** Test Mail *******
**** Please drop. *****

{{ $schedule_info["name"] }} 様

ShareCOOKで下記の予約を受付しました。

お客様名：{{ $user_reservation->user()->value("name") }} 様
日付：{{ $schedule_info["date_jp"] }}
区分：{{ $schedule_info["meal_type"] }}
希望時間：{{ $user_reservation->visit_time }}
謝礼額：{{ $schedule_info["price_str"] }}
住所：{{ $user_reservation->user()->value("address") }}
電話番号：{{ $user_reservation->user()->value("phone") }}
メッセージ：{{ $user_reservation->message }}

シェフ会員ページにログインの上、予約状況をご確認ください。
{{ 'https://'. $_SERVER['HTTP_HOST'] . '/workers/login' }}

~~~~~~~~~~~~~~~~~~
ShareCOOK
{{ 'https://'. $_SERVER['HTTP_HOST'] }}