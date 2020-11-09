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
        for ($i = 1; $i <= 10; $i++) {
        
            DB::table('workers')->insert([
                'name' => 'テスト料理人'.$i,
                'email' => 'test'.$i.'@jnsq.net',
                'password' => bcrypt('11112222'),
                'public_flag' => 1, 
                'phone' => '09011112222', 
                'nickname' => 'シェフ'.$i, 
                'price_lunch' => 2000, 
                'price_dinner' => 3000, 
                'amature_career' => 2, 
                'pro_career' => 3, 
                'portrait_filename' => '', 
                'comment' => 'テストコメント', 
            ]);
        }
    }
}
