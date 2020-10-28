<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Calendar\WorkerScheduleView;
use App\Worker;

class WorkersInfoController extends Controller
{
	public function index(){
   	
   		$workers = Worker::orderBy('updated_at', 'desc')->paginate(5);
   		
   		return view('workers_list', [
            'workers' => $workers,
        ]);
   	
	}
	
	public function show(Request $request){
	
		// クエリからworker_idと年月を受け取る
		$worker_id = $request->wid;
		$date = $request->input("date");

		// worker_idがあればインスタンス生成
		$worker = Worker::findOrFail($worker_id);
	
		//dateがYYYY-MMの形式かどうか判定する
		if($date && preg_match("/^[0-9]{4}-[0-9]{2}$/", $date)){
			$date = strtotime($date . "-02");	// "-01"ではなぜか前月扱いになってしまうため
		}else{
			$date = null;
		}
		
		//取得出来ない時は現在(=今月)を指定する
		if(!$date)$date = time();
	
		//予約カレンダーを取得
		$calendar = new WorkerScheduleView($date, $worker_id);

		return view('workers_info', [
			"calendar" => $calendar,
			"worker" => $worker
		]);
	}
}
