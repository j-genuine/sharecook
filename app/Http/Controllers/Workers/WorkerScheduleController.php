<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Workers\WorkerScheduleFormView;
use App\Calendar\WorkerSchedule;

class WorkerScheduleController extends Controller
{

    public function form(Request $request){
		
		$worker = \Auth::user();
		
		//クエリーのdateを受け取る
		$date = $request->input("date");

		//dateがYYYY-MMの形式かどうか判定する
		if($date && strlen($date) == 7){
			$date = strtotime($date . "-02");
		}else{
			$date = null;
		}
		
		//取得出来ない時は現在(=今月)を指定する
		if(!$date)$date = time();
		
		//フォームを表示
		$calendar = new WorkerScheduleFormView($date, $worker->id);

		return view('workers/worker_schedule_edit', [
			"worker" => $worker,
			"calendar" => $calendar,
		]);
	}
	public function update(Request $request){
	    
	    $worker_id = \Auth::id();

		$input = $request->get("worker_schedule");
		$ym = $request->input("ym");
		$date = $request->input("date");
		
		WorkerSchedule::updateWorkerScheduleWithMonth($ym, $input, $worker_id);
		return redirect()
			->action("Workers\WorkerScheduleController@form", ["date" => $date])
			->withStatus("保存しました");
	}
}
