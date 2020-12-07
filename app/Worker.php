<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cloudinary;
use App\Notifications\WorkerPasswordResetNotification;
use App\Notifications\WorkerVerifyEmail;

class Worker extends Authenticatable implements MustVerifyEmailContract
{
    use MustVerifyEmail, Notifiable;

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
     * パスワードリセット用にオーバーライド
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new WorkerPasswordResetNotification($token));
    }

    /**
     * メール認証用にオーバーライド
     */
    //public function sendEmailVerificationNotification()
    //{
    //    $this->notify(new WorkerVerifyEmail());
    //}

    /**
     * Cloudinary用のpublic_idを取得
     * 
     * @return string
     */
    public function public_id()
    {
        return (pathinfo($this->portrait_filename))['filename'];
    }

    /**
     * プロフィール画像表示html用のimg要素を取得
     * 
     * @param  integer $width=150, $height=150
     * @return string
     */
    public function portraitImageTag($width=150, $height=150)
    {
        $public_id = $this->public_id();
        //Public Idが無い(会員テーブルに登録が無い)場合は、ダミー画像のタグを返す
        if(!$public_id) return '<img src="/images/portrait_dummy.png" width="'.$width.'" height='.$height.' />';
        
        $cloudinary = new Cloudinary(config('sharecook.cloudinary_url'));
        return $cloudinary->imageTag(config('sharecook.portrait_folder')."/".$public_id)->fill($width, $height);
    }

    /**
     * プロフィール画像のアップロード処理
     * 
     * @param  画像ファイルのパス, 接頭文字
     * @return string アップロードファイル名
     */
    static function uploadPortraitImage($image_file_path, $prefix="")
    {
        //新規でpublic_id作成
        $public_id = $prefix."_".crc32(time());
        
        //Cloudinaryにアップロード
        $cloudinary = new Cloudinary(config('sharecook.cloudinary_url'));
        $upload_image = $cloudinary->uploadApi()->upload($image_file_path, ['public_id' => $public_id, 'folder' => config('sharecook.portrait_folder')]);

        return basename($upload_image["url"]);
    }
    
    /**
     * プロフィール画像の削除処理
     * 
     * @param  
     * @return 
     */
    public function destroyPortraitImage()
    {
        //Cloudinaryから削除
        $cloudinary = new Cloudinary(config('sharecook.cloudinary_url'));
        $res = $cloudinary->uploadApi()->destroy(config('sharecook.portrait_folder').'/'.$this->public_id());

        return $res;
    }

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
    
    /**
     * 料理画像テーブル(work_images)との連結
     */
    public function workImages()
    {
        return $this->hasMany(Workers\WorkImage::class);
    }

}
