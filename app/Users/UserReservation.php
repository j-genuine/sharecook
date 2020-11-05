<?php

namespace App\Users;

use Illuminate\Database\Eloquent\Model;

class UserReservation extends Model
{
    protected $fillable = [
            'user_id', 'worker_schedule_id', 'visit_time', 'message', 'price',
    ];

    /**
     * 指定のシェフ会員の予約情報を取得
     * 
     * @param  id    シェフ会員ID
     * @return array 予約済み予約情報
     */
    static function workerReservedInfo($worker_id){
        
        return self::leftjoin('worker_schedules','worker_schedule_id','worker_schedules.id')->where('worker_id',$worker_id)->get();
    }

    /**
     * カスタマー会員テーブル(Users)との連結
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 稼働スケジュールテーブル(workerSchedules)との連結
     */
    public function workerSchedule()
    {
        return $this->belongsTo(\App\Calendar\WorkerSchedule::class);
    }

}
