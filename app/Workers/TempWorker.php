<?php

namespace App\Workers;

use Illuminate\Database\Eloquent\Model;

class TempWorker extends Model
{
    protected $fillable = [
        'email', 'hash', 
    ];
}
