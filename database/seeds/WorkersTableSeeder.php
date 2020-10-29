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
        DB::table('workers')->insert([
            'name' => 'テスト料理人１',
            'email' => 'test1@jnsq.net',
            'password' => bcrypt('11112222'),
            'public_flag' => 1, 
            'phone' => '03011112222', 
            'nickname' => 'シェフ１', 
            'price_lunch' => 2000, 
            'price_dinner' => 3000, 
            'amature_career' => 2, 
            'pro_career' => 3, 
            'portrait_filename' => '', 
            'comment' => 'パスタが得意です。', 
        ]);
        DB::table('workers')->insert([
            'name' => 'テスト料理人２',
            'email' => 'test2@jnsq.net',
            'password' => bcrypt('11112222'),
            'public_flag' => 1, 
            'phone' => '03022223333', 
            'nickname' => 'シェフ２', 
            //'price_lunch' => 0,
            'price_dinner' => 4000, 
            'amature_career' => 5, 
            'pro_career' => 10, 
            'portrait_filename' => '', 
            'comment' => '料亭で10年間修業しました。', 
        ]);
    }
}
