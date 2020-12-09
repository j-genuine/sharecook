<?php

namespace App\Workers;

use Illuminate\Database\Eloquent\Model;

class TempWorker extends Model
{
    protected $fillable = [
        'email', 'hash', 
    ];

    /**
     * 新規レコード作成処理
     * 
     * @param  string $email
     * @return TempWorker
     */
    static function store($email){

        //一日以上前のデータを削除後、レコード作成
        self::clean();
        $temp_worker = self::create([
            'email' => $email,
            'hash' => sha1(uniqid(mt_rand(), true)),    //照合用のハッシュキー生成
        ]);

        return $temp_worker;
    }

    /**
     * レコード削除処理（無効レコード一括削除機能付き）
     * 
     * @param  string $email=""
     * @return integer
     */
    static function clean($email=""){

        $rows=0;
        //メールアドレス指定があれば、該当レコード削除
        if(isset($email)) $rows += self::where('email',$email)->delete();
        //一日以上前のデータ(無効レコード)を削除
        $rows += self::whereDate('created_at',"<", date("Y-m-d",strtotime("-1 day")))->delete();

        return $rows;
    }
}
