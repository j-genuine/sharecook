<?php

use Illuminate\Database\Seeder;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datum = [
        ['name' => '和食'],
        ['name' => '中華'],
        ['name' => 'アジア'],
        ['name' => 'イタリアン'],
        ['name' => 'フレンチ'],
        ['name' => 'その他洋食'],
        ['name' => '無国籍'],
        ['name' => 'スイーツ'],
        ['name' => 'その他'],
        ];

        DB::table('skills')-> insert($datum);
    }
}
