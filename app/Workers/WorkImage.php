<?php

namespace App\Workers;

use Illuminate\Database\Eloquent\Model;
use Cloudinary;

class WorkImage extends Model
{
    //最大画像保存数
    public static $max_image_num = 100;
    
    protected $fillable = [
        'worker_id', 'image_filename', 'comment'
    ];
    
    /**
     * Cloudinary用のpublic_idを取得
     * 
     * @return string
     */
    public function public_id()
    {
        return (pathinfo($this->image_filename))['filename'];
    }

    /**
     * 料理画像表示html用のimg要素を取得
     * 
     * @param  integer $width=150, $height=150
     * @return string
     */
    public function workImageTag($width=150, $height=150)
    {
        $public_id = $this->public_id();
        //Public Idが無い(画像テーブルに登録が無い)場合は、ダミー画像のタグを返す
        if(!$public_id) return '<img src="/images/work_image_dummy.png" width="'.$width.'" height='.$height.' />';
        
        $cloudinary = new Cloudinary(config('sharecook.cloudinary_url'));
        return $cloudinary->imageTag(config('sharecook.work_image_folder')."/".$public_id)->fill($width, $height);
    }
    
    /**
     * 最大画像保存数を取得
     * 
     * @return integer
     */
    static function maxImageNum()
    {
        return self::$max_image_num;
    }
    
    /**
     * 料理画像のアップロード処理
     * 
     * @param  画像ファイルのパス, 接頭文字
     * @return string アップロードファイル名
     */
    static function uploadWorkImage($image_file_path, $prefix="")
    {
        //新規でpublic_id作成
        $public_id = $prefix."_".md5(time());
        
        //Cloudinaryにアップロード
        $cloudinary = new Cloudinary(config('sharecook.cloudinary_url'));
        $upload_image = $cloudinary->uploadApi()->upload($image_file_path, ['public_id' => $public_id, 'folder' => config('sharecook.work_image_folder')]);

        return basename($upload_image["url"]);
    }
    
    /**
     * 料理画像の削除処理
     * 
     * @param  
     * @return 
     */
    public function destroyWorkImage()
    {
        //Cloudinaryから削除
        $cloudinary = new Cloudinary(config('sharecook.cloudinary_url'));
        $res = $cloudinary->uploadApi()->destroy(config('sharecook.work_image_folder').'/'.$this->public_id());

        return $res;
    }

    /**
     * シェフ会員テーブル(Workers)との連結
     */
    public function worker()
    {
        return $this->belongsTo(\App\Worker::class);
    }
    
}
