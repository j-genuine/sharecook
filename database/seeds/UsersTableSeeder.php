<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'テストユーザー１',
            'email' => 'user1@test.test',
            'password' => bcrypt('11112222'),
            'zip_cd' => 1000001,
            'area_id' => '13',
            'address' => '千代田区千代田１',
            'phone' => '09011112222',
        ]);
        DB::table('users')->insert([
            'name' => 'テストユーザー２',
            'email' => 'user2@test.test',
            'password' => bcrypt('11112222'),
            'zip_cd' => 1638001,
            'area_id' => '13',
            'address' => '新宿区西新宿２丁目８－１',
            'phone' => '09022223333',
        ]);
        DB::table('users')->insert([
            'name' => 'テストユーザー３',
            'email' => 'user3@test.test',
            'password' => bcrypt('11112222'),
            'zip_cd' => 5400002,
            'area_id' => '27',
            'address' => '大阪市中央区大阪城１－１',
            'phone' => '09033334444',
        ]);
    }
}
