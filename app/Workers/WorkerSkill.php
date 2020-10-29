<?php

namespace App\Workers;

use Illuminate\Database\Eloquent\Model;

class WorkerSkill extends Model
{
    protected $fillable = [
        'worker_id', 'skill_id', 'priority_flag'
    ];
    
	/**
     * シェフ会員テーブル(Workers)との連結
     */
    public function worker()
    {
        return $this->belongsTo(\App\Worker::class);
    }
    
    /**
     * 料理スキルマスター(Skills)との連結
     */
    public function Skill()
    {
        return $this->belongsTo(\App\Skill::class);
    }
}
