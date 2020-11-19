<?php

use Illuminate\Database\Seeder;
use App\Workers\WorkImage;

class WorkImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        WorkImage::create(['worker_id'=>3,'image_filename'=>'3_a1855e0485aa307cb322cf7f6efd5c97.jpg','comment'=>'焼き鳥みたいなやつ']);
        WorkImage::create(['worker_id'=>3,'image_filename'=>'3_710521d03aa0f970f140bd4c78cd9508.jpg','comment'=>'']);
        WorkImage::create(['worker_id'=>3,'image_filename'=>'3_361200604b24bf12f7c7cec8b52a27ad.jpg','comment'=>'残り物のベーコンとほうれん草でクリームパスタ']);
        WorkImage::create(['worker_id'=>3,'image_filename'=>'3_454bd71515e8864b1f7f8bea1bbf0cbc.jpg','comment'=>'ああああ']);
        WorkImage::create(['worker_id'=>3,'image_filename'=>'3_815a5cdcc6dc27b7e7d2375575a88c42.jpg','comment'=>'餃子餃子餃子餃子']);
        WorkImage::create(['worker_id'=>6,'image_filename'=>'6_337cb2d5c955ff9950eda0c50d49db9c.jpg','comment'=>'とてもおいしいステーキ']);
        WorkImage::create(['worker_id'=>8,'image_filename'=>'8_d96c6724be9a7a023750de02bf118225.jpg','comment'=>'ラーメン']);
        WorkImage::create(['worker_id'=>9,'image_filename'=>'9_203273e593abe5c152b6bb7652f2e37a.jpg','comment'=>'カレー']);
    
    }
}
