<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Notifications\UserPasswordResetNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'zip_cd', 'area_id', 'address'
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
     * パスワードリセットメールの日本語化用にオーバーライド
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserPasswordResetNotification($token));
    }
    
    /**
     * カスタマー予約テーブル(UserReservations)との連結
     */
    public function userReservations()
    {
        return $this->hasMany(Users\UserReservation::class);
    }
    
    /**
     * 地域名マスター(Areas)との連結
     */
    public function Area()
    {
        return $this->belongsTo(Area::class);
    }
}
