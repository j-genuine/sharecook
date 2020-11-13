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
	 * 指定した月の稼働可能状況を取得する
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
	
	/**
     * 取得や成型が面倒な各種スケジュール情報を、まとめて作成して配列で返す
     * 
     * @return array[
     *		'date'	=> 日付(yyyy/mm/dd),
     * 		'date_jp'	=> 日付(yyyy年mm月dd日),
     *		'meal_type'	=> ランチ or ディナー,
     * 		'comment'	=> スケジュールのコメント,
     * 		'worker_id'	=> シェフ会員ID,
     * 		'name'	=> シェフの名前,
     *		'nickname'	=> シェフのニックネーム,
     * 		'email'	=> シェフのemail,
     * 		'price'	=> 価格(数値),
     *  	'price_str'	=> 価格(カンマ区切り文字。0なら'指定なし'),
     * 		'phone'	=> シェフの電話番号,
     * ]
     */
	public function scheduleInfo(){
		
		$schedule_info = array();
		$worker = $this->worker()->first();
		
		//成型した予約日
		$date_key = $this->date_key;
		$schedule_info['date'] = substr($date_key,0,4)."/".substr($date_key,4,2)."/".substr($date_key,-2);
		$schedule_info['date_jp'] = substr($date_key,0,4)."年".substr($date_key,4,2)."月".substr($date_key,-2)."日";
		
		//ディナー／ランチ区分と価格
		if($this->noon_flag == 1){
    		$schedule_info['meal_type'] = "ランチ";
    		$schedule_info['price'] = $worker->price_lunch;
		}else{
			$schedule_info['meal_type'] = "ディナー";
    		$schedule_info['price'] = $worker->price_dinner;
		}

		//成型した価格
		$schedule_info['price_str'] = $schedule_info['price'] ? "￥".number_format($schedule_info['price']) : "指定なし";
		
		//その他の情報
		$schedule_info['worker_id'] = $this->worker_id;
		$schedule_info['comment'] = $this->comment;
		$schedule_info['name'] = $worker->name;
		$schedule_info['nickname'] = $worker->nickname;
		$schedule_info['email'] = $worker->email;
		$schedule_info['phone'] = $worker->phone;
		
		return $schedule_info;	
	}
	
	/**
     * シェフ会員テーブル(Workers)との連結
     */
    public function worker()
    {
        return $this->belongsTo(\App\Worker::class);
    }

    /**
     * カスタマー予約テーブル(UserReservations)との連結
     */
    public function userReservation()
    {
        return $this->hasOne(\App\Users\UserReservation::class);
    }

}
