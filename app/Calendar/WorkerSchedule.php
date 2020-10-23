<?php

namespace App\Calendar;

use Illuminate\Database\Eloquent\Model;

class WorkerSchedule extends Model
{
    const LUNCH_OK = 1;
	const DINNER_OK = 2;
	protected $table = "worker_schedules";
	
	protected $fillable = [
		"comment",
	];
	function isLunchClose(){
		return $this->noon_flag != WorkerSchedule::LUNCH_OK;
	}
	function isLunchOpen(){
		return $this->noon_flag == WorkerSchedule::LUNCH_OK;
	}
	function isDinnerClose(){
		return $this->noon_flag != WorkerSchedule::DINNER_OK;
	}
	function isDinnerOpen(){
		return $this->noon_flag == WorkerSchedule::DINNER_OK;
	}
	
	/**
	 * 指定した月の営業・休業を取得する
	 */
	public static function getWorkerScheduleWithMonth($ym, $worker_id){
		return WorkerSchedule::where([["date_key", 'like', $ym . '%'],["worker_id", "=", $worker_id]])
            ->get()->groupBy("date_key");
	}
	
	/**
	 * 一括で更新する
	 */
	public static function updateWorkerScheduleWithMonth($ym, $input, $worker_id){
		
		$workerSchedules = self::getWorkerScheduleWithMonth($ym,$worker_id);

		foreach($input as $date_key => $array){
			
			// 予約済みフラグ初期化
			$lunch_nochange_flag=0;
			$dinner_nochange_flag=0;

			if(isset($workerSchedules[$date_key])){	//その日付で既に予約がある場合

				// 1日にランチ、ディナー、もしくは両方のレコードがあるためループ
				foreach($workerSchedules[$date_key] as $key => $workerSchedules_1day){

					// 予約登録済みでチェックが入っていれば無視、外されていたら予約削除
					switch($noon_flag = $workerSchedules_1day['noon_flag']){
						case 1:
							if($input[$date_key]['lunch_comment'] || isset($workerSchedules_1day['comment'])){	// コメント入力があるか、元々あったら更新
								WorkerSchedule::where([["date_key", "=", $date_key],["worker_id", "=", $worker_id],["noon_flag", "=", $noon_flag]])->update(['comment' => $input[$date_key]['lunch_comment']]);
							}
							if(isset($input[$date_key]['lunch_flag'])){	// チェックボックス（ランチ）
								$lunch_nochange_flag = 1;
							}else{
								WorkerSchedule::where([["date_key", "=", $date_key],["worker_id", "=", $worker_id],["noon_flag", "=", $noon_flag]])->delete();
							}
							break;
						case 2:
							if($input[$date_key]['dinner_comment'] || isset($workerSchedules_1day['comment'])){	// コメント入力があるか、元々あったら更新
								WorkerSchedule::where([["date_key", $date_key],["worker_id", $worker_id],["noon_flag", $noon_flag]])->update(['comment' => $input[$date_key]['dinner_comment']]);
							}
							if(isset($input[$date_key]['dinner_flag'])){	// チェックボックス（ディナー）
								$dinner_nochange_flag = 1;
							}else{
								WorkerSchedule::where([["date_key", "=", $date_key],["worker_id", "=", $worker_id],["noon_flag", "=", $noon_flag]])->delete();
							}
							break;
					}
				}
			}

			// 新規の予約
			// ※ランチにチェックがあり予約済みで無ければ、1予約レコード作成
			if(isset($input[$date_key]['lunch_flag']) && !$lunch_nochange_flag){
				$workerSchedule = new WorkerSchedule();
				$workerSchedule->date_key = $date_key;
				$workerSchedule->worker_id = $worker_id;
				$workerSchedule->noon_flag = 1;
				$workerSchedule->comment = $input[$date_key]['lunch_comment'];
				
				$workerSchedule->save();
			}
			// ※ディナーにチェックがあり予約済みで無ければ、1予約レコード作成
			if(isset($input[$date_key]['dinner_flag']) && !$dinner_nochange_flag){
				$workerSchedule = new WorkerSchedule();
				$workerSchedule->date_key = $date_key;
				$workerSchedule->worker_id = $worker_id;
				$workerSchedule->noon_flag = 2;
				$workerSchedule->comment = $input[$date_key]['dinner_comment'];
				
				$workerSchedule->save();
			}
		}
	}
}
