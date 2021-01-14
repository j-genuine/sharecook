<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Calendar\WorkerScheduleView;
use App\Worker;

class WorkersInfoController extends Controller
{
	public function index(Request $request){
		
   		$sql_where_array = array("public_flag" => 1);

   		if($request->area_id) $sql_where_array["area_id"] = $request->area_id;
   		if($request->skill_id) $sql_where_array["skill_id"] = $request->skill_id;

   		//検索条件に合ったシェフ情報を取得   	
   		$workers = Worker::select("workers.id","nickname","price_lunch","price_dinner","portrait_filename",'workers.updated_at')
   			->leftjoin("worker_skills","worker_skills.worker_id","workers.id")
   			->leftjoin("worker_areas","worker_areas.worker_id","workers.id")
			->where($sql_where_array)
			->groupBy("workers.id","nickname","price_lunch","price_dinner","portrait_filename",'workers.updated_at')
			->orderBy('workers.updated_at', 'desc')->paginate(10);
		
		return view('workers_list', [
            'workers' => $workers,
            'area_id' => $request->area_id,
			'skill_id' => $request->skill_id,
        ]);
   	
	}
	
	public function show(Request $request){
	
		// クエリからworker_idと年月を受け取る
		$worker_id = $request->wid;
		$date = $request->date;

		// worker_idがあればインスタンス生成
		$worker = Worker::findOrFail($worker_id);

		// 非公開に設定している場合、予約があるworker以外は表示不可
		if(!$worker->public_flag){
			\App\Users\UserReservation::select("user_reservations.id")
				->leftjoin("worker_schedules","worker_schedules.id","=","worker_schedule_id")
				->where("worker_id",$worker_id)->firstOrFail();
		}
		
		// 料理画像インスタンス生成
		$work_images = $worker->workImages()->orderBy("created_at","desc")->paginate(3);
		// ページネーション
		$image_page_links = $work_images->appends(['wid' => $worker_id, 'date' => $date])->links();
	
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
			"worker" => $worker,
			"work_images" => $work_images,
			"image_page_links" => $image_page_links,
		]);
	}
}
