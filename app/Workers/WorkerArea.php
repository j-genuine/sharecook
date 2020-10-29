<?php

namespace App\Workers;

use Illuminate\Database\Eloquent\Model;

class WorkerArea extends Model
{
    protected $fillable = [
        'worker_id', 'area_id', 'priority_flag'
    ];
    
	/**
     * シェフ会員テーブル(Workers)との連結
     */
    public function worker()
    {
        return $this->belongsTo(\App\Worker::class);
    }

    /**
     * 地域名マスター(Areas)との連結
     */
    public function Area()
    {
        return $this->belongsTo(\App\Area::class);
    }
    
}
