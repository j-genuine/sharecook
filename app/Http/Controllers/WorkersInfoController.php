<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Calendar\WorkerScheduleView;

class WorkersInfoController extends Controller
{
   public function show(Request $request){

		//テスト用
		$worker_id = $request->wid;

		//クエリーのdateを受け取る
		$date = $request->input("date");

		//dateがYYYY-MMの形式かどうか判定する
		if($date && preg_match("/^[0-9]{4}-[0-9]{2}$/", $date)){
			$date = strtotime($date . "-02");	// "-01"ではなぜか前月扱いになってしまうため
		}else{
			$date = null;
		}
		
		//取得出来ない時は現在(=今月)を指定する
		if(!$date)$date = time();

		//カレンダーに渡す
		//$calendar = new CalendarOutputView($date);
		$calendar = new WorkerScheduleView($date, $worker_id);
		return view('workers_info', [
			"calendar" => $calendar,
			"worker_id" => $worker_id
		]);
	}
}
