<html>
<body>
****** Test Mail *******<br />
**** Please drop. *****<br />
<br />
{{ $schedule_info["name"] }} 様<br />
<br />
ShareCOOKで下記の予約を受付しました。<br />
<br />
お客様名：{{ $user_reservation->user()->value("name") }} 様<br />
日付：{{ $schedule_info["date_jp"] }}<br />
区分：{{ $schedule_info["meal_type"] }}<br />
希望時間：{{ $user_reservation->visit_time }}<br />
謝礼額：{{ $schedule_info["price_str"] }}<br />
住所：{{ $user_reservation->user()->value("address") }}<br />
電話番号：{{ $user_reservation->user()->value("phone") }}<br />
メッセージ：{{ $user_reservation->message }}<br />
<br />
シェフ会員ページにログインの上、予約状況をご確認ください。<br />
{{ 'https://'. $_SERVER['HTTP_HOST'] . '/workers/login' }}<br />
<br />
~~~~~~~~~~~~~~~~~~<br />
ShareCOOK<br />
{{ 'https://'. $_SERVER['HTTP_HOST'] }}
</body>
</html>