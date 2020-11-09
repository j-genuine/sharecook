<?php

use Illuminate\Database\Seeder;

class WorkersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 12; $i++) {

            \App\Worker::create([
                'name' => 'テスト料理人'.$i,
                'email' => 'test'.$i.'@jnsq.net',
                'password' => bcrypt('11112222'),
                'public_flag' => 1, 
                'phone' => '090'.random_int(10000000, 99999999),
                'nickname' => 'シェフ'.$i,
                'price_lunch' => random_int(2,10)*500, 
                'price_dinner' => random_int(3,15)*500, 
                'amature_career' => random_int(0,30),
                'pro_career' => random_int(0,20),
                'portrait_filename' => '',
                'comment' => 'テストコメント', 
            ]);
        }
    }
}
