<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Worker extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'public_flag', 'phone', 'nickname', 'price_lunch', 'price_dinner', 'amature_career', 'pro_career', 'portrait_filename', 'comment',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * 稼働スケジュールテーブル(worker_schedules)との連結
     */
    public function workerSchedules()
    {
        return $this->hasMany(Calendar\WorkerSchedule::class);
    }
    
    /**
     * 出張可能エリアテーブル(worker_areas)との連結
     */
    public function workerAreas()
    {
        return $this->hasMany(Workers\WorkerArea::class);
    }
    
    /**
     * 得意スキルテーブル(worker_skills)との連結
     */
    public function workerSkills()
    {
        return $this->hasMany(Workers\WorkerSkill::class);
    }

}
