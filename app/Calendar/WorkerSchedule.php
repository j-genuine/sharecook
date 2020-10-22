<?php

namespace App\Calendar;

use Illuminate\Database\Eloquent\Model;

class WorkerSchedule extends Model
{
    const LUNCH_OK = 1;
	const DINNER_OK = 2;
	protected $table = "worker_schedules";
	
	protected $fillable = [
		"noon_flag",
		"comment"
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
	 * @return ExtraHoliday[]
	 */
	public static function getWorkerScheduleWithMonth($ym, $worker_id){
		return WorkerSchedule::where([["date_key", 'like', $ym . '%'],["worker_id", "=", $worker_id]])
            ->get()->groupBy("date_key");
	}
	
	/**
	 * 一括で更新する
	 */
	public static function updateWorkerScheduleWithMonth($ym, $input){
		
		$workerSchedules = self::getWorkerScheduleWithMonth($ym);

		foreach($input as $date_key => $array){
			
			if(isset($workerSchedules[$date_key])){	//既に作成済の場合

				$workerSchedule = $workerSchedules[$date_key];
				$workerSchedule->fill($array);

				//LunchかDinnerのどちらかにチェックされている場合は上書き
				if(isset($input[$date_key]['lunch_flag']) || isset($input[$date_key]['dinner_flag'])){
					$workerSchedule->save();
					
				//どちらもチェック無し（外された）場合は削除
				}else{
					$workerSchedule->delete();

				}
				continue;
			}

			$workerSchedule = new WorkerSchedule();
			$workerSchedule->date_key = $date_key;
			$workerSchedule->user_id = "1";
			$workerSchedule->fill($array);

			//LunchかDinnerどちらかがOpen指定の場合は保存
			if($workerSchedule->isLunchOpen() || $workerSchedule->isDinnerOpen()){
				$workerSchedule->save();
			}
		}
	}
}
