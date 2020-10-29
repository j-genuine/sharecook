<?php

namespace App\Users;

use Illuminate\Database\Eloquent\Model;

class UserReservation extends Model
{
    protected $fillable = [
            'user_id', 'worker_schedule_id', 'visit_time', 'message', 'price',
    ];

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
