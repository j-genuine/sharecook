<?php

use Illuminate\Database\Seeder;

class HolidaySettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('holiday_setting')->delete();
        
        \App\Calendar\HolidaySetting::create([
            'flag_mon' => 1 ,
            'flag_tue' => 1 ,
            'flag_wed' => 1 ,
            'flag_thu' => 1 ,
            'flag_fri' => 1 ,
            'flag_sat' => 1 ,
            'flag_sun' => 2 ,
            'flag_holiday' => 2,
        ]);
    }
}
