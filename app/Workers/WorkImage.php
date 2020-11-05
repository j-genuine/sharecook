<?php

namespace App\Workers;

use Illuminate\Database\Eloquent\Model;
use Cloudinary;

class WorkImage extends Model
{
    //料理画像の保存先クラウド上のフォルダ名
    public static $image_folder = "work_images";
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
        $cloudinary = new Cloudinary(env('CLOUDINARY_URL'));
        return $cloudinary->imageTag(self::$image_folder."/".$this->public_id())->fill($width, $height);
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
        $cloudinary = new Cloudinary(env('CLOUDINARY_URL'));
        $upload_image = $cloudinary->uploadApi()->upload($image_file_path, ['public_id' => $public_id, 'folder' => self::$image_folder]);

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
        $cloudinary = new Cloudinary(env('CLOUDINARY_URL'));
        $res = $cloudinary->uploadApi()->destroy(self::$image_folder.'/'.$this->public_id());

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
