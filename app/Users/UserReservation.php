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
     * @param  id (,int paginate)    シェフ会員ID (,ページネーション数)
     * @return array 予約済み予約情報
     */
    static function workerReservedInfo($worker_id, $paginate = 0){
        
        return self::leftjoin('worker_schedules','worker_schedule_id','worker_schedules.id')
            ->where('worker_id',$worker_id)
            ->orderBy("date_key","desc")->paginate($paginate);
    }

    /**
     * カスタマー会員テーブル(Users)との連結
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * 稼働スケジュールテーブル(workerSchedules)との連結
     */
    public function workerSchedule()
    {
        return $this->belongsTo(\App\Calendar\WorkerSchedule::class);
    }

}
