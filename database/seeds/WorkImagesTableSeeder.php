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

        WorkImage::create(['id'=>3,'worker_id'=>2,'image_filename'=>'2_4b1297462d2c3e79eda423e6cb0f086e.jpg','comment'=>'パスタ']);
        WorkImage::create(['id'=>4,'worker_id'=>2,'image_filename'=>'2_f01bc5ce2c7ef1c8e55e98638201896a.jpg','comment'=>'真鯛のポワレ']);
        WorkImage::create(['id'=>5,'worker_id'=>3,'image_filename'=>'3_5e4c7986c35c5aa7998412f0e267562c.jpg','comment'=>'']);
        WorkImage::create(['id'=>6,'worker_id'=>4,'image_filename'=>'4_ec1899442963dcbb1d0effe6f57499a4.jpg','comment'=>'']);
        WorkImage::create(['id'=>7,'worker_id'=>5,'image_filename'=>'5_75ef2c169be2f785dd3b1391d74d94cf.jpg','comment'=>'点心']);
        WorkImage::create(['id'=>8,'worker_id'=>5,'image_filename'=>'5_b251065bed44481e4b03df106b61866d.jpg','comment'=>'']);
        WorkImage::create(['id'=>9,'worker_id'=>11,'image_filename'=>'11_1e615e9596dc160d5dd9876087ea3ac9.jpg','comment'=>'']);
        WorkImage::create(['id'=>10,'worker_id'=>11,'image_filename'=>'11_8169908e30f6c65e192c6e5bfb517294.jpg','comment'=>'']);
        WorkImage::create(['id'=>11,'worker_id'=>11,'image_filename'=>'11_0afa16003ff57dc113a925fc3b5d6cac.jpg','comment'=>'']);
        WorkImage::create(['id'=>12,'worker_id'=>11,'image_filename'=>'11_95235ab29a0d3aff4e948df009a59469.jpg','comment'=>'']);
        WorkImage::create(['id'=>13,'worker_id'=>11,'image_filename'=>'11_5493e19776b3340a2cadaba20d3c0096.jpg','comment'=>'とてもおいしゅうございました。']);
        WorkImage::create(['id'=>14,'worker_id'=>12,'image_filename'=>'12_44cf87c9682827fec11af7db677e220e.jpg','comment'=>'']);
        WorkImage::create(['id'=>15,'worker_id'=>12,'image_filename'=>'12_25fd4893648793d3dc23a498df9e551d.jpg','comment'=>'今朝仕入れたカンパチ']);
        WorkImage::create(['id'=>2,'worker_id'=>1,'image_filename'=>'1_2568f7faa70cca79d720f2aa50821de9.jpg','comment'=>'おでん']);
        WorkImage::create(['id'=>1,'worker_id'=>1,'image_filename'=>'1_00dc142738f62542f702b4e968f7e082.jpg','comment'=>'ラーメン']);
        WorkImage::create(['id'=>18,'worker_id'=>6,'image_filename'=>'6_63ad969a24598e41f7580abe9bfe4bfe.jpg','comment'=>'創作寿司です。きれいにできました。']);
        WorkImage::create(['id'=>19,'worker_id'=>8,'image_filename'=>'8_09a7c6cb43c3a1226a549d8cd9ab2cda.jpg','comment'=>'']);
        WorkImage::create(['id'=>20,'worker_id'=>9,'image_filename'=>'9_39eb718336053969eeee2e32aa9dc516.jpg','comment'=>'']);
        WorkImage::create(['id'=>21,'worker_id'=>9,'image_filename'=>'9_595f922a4d7d6d9bf17a308fde0f0164.jpg','comment'=>'']);
        WorkImage::create(['id'=>22,'worker_id'=>9,'image_filename'=>'9_a203ece6f4e2919897382fd71a501e32.jpg','comment'=>'']);
        WorkImage::create(['id'=>23,'worker_id'=>9,'image_filename'=>'9_de7301f843e7c7bfc888461368a575b2.jpg','comment'=>'']);
        WorkImage::create(['id'=>24,'worker_id'=>10,'image_filename'=>'10_e6fd0d2736c6ec6841f492209cb83b60.jpg','comment'=>'']);
        WorkImage::create(['id'=>25,'worker_id'=>10,'image_filename'=>'10_c5e92c36d9b761e2579146a770b6dff8.jpg','comment'=>'家で漬けたぬか漬けです']);
        WorkImage::create(['id'=>26,'worker_id'=>3,'image_filename'=>'3_592185dea4f6596164a806581684ac3e.jpg','comment'=>'']);
        WorkImage::create(['id'=>28,'worker_id'=>3,'image_filename'=>'3_8816b2188dae74a7718f375eb3f56f9d.jpg','comment'=>'朝摘みハーブを使ったサラダ']);
        WorkImage::create(['id'=>30,'worker_id'=>3,'image_filename'=>'3_8c11c3b9f3ebd4c2dc5e7a01fb24f39e.jpg','comment'=>'かつおのカルパッチョ。柑橘系のソースを使っています。']);
        WorkImage::create(['id'=>29,'worker_id'=>3,'image_filename'=>'3_508dd210ebd1cbf8d7b05cca1e5aec89.jpg','comment'=>'チキンのスピエディーニ。照り焼き風でお子様にも喜んでいただけました。']);
    
    }
}
