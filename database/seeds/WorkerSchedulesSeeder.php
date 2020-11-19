<?php

use Illuminate\Database\Seeder;
use App\Calendar\WorkerSchedule;

class WorkerSchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        WorkerSchedule::create(['worker_id'=>3,'date_key'=>'20201009','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>3,'date_key'=>'20201021','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>3,'date_key'=>'20201021','noon_flag'=>2,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>3,'date_key'=>'20201030','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>3,'date_key'=>'20201031','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>3,'date_key'=>'20201031','noon_flag'=>2,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>3,'date_key'=>'20201107','noon_flag'=>1,'comment'=>'ああああ']);
        WorkerSchedule::create(['worker_id'=>3,'date_key'=>'20201112','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>3,'date_key'=>'20201112','noon_flag'=>2,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>3,'date_key'=>'20201115','noon_flag'=>2,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>3,'date_key'=>'20201122','noon_flag'=>1,'comment'=>'いいいいい']);
        WorkerSchedule::create(['worker_id'=>3,'date_key'=>'20201128','noon_flag'=>2,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>3,'date_key'=>'20201129','noon_flag'=>2,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>3,'date_key'=>'20201210','noon_flag'=>2,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>3,'date_key'=>'20201225','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>3,'date_key'=>'20201226','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>3,'date_key'=>'20201226','noon_flag'=>2,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>4,'date_key'=>'20201113','noon_flag'=>2,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>4,'date_key'=>'20201118','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>4,'date_key'=>'20201129','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>4,'date_key'=>'20201129','noon_flag'=>2,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>4,'date_key'=>'20201211','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>4,'date_key'=>'20201212','noon_flag'=>2,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>4,'date_key'=>'20201215','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>4,'date_key'=>'20201220','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>4,'date_key'=>'20201220','noon_flag'=>2,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>4,'date_key'=>'20201227','noon_flag'=>2,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>4,'date_key'=>'20210102','noon_flag'=>2,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>4,'date_key'=>'20210113','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>4,'date_key'=>'20201224','noon_flag'=>2,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>4,'date_key'=>'20201112','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>8,'date_key'=>'20201119','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>8,'date_key'=>'20201124','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>8,'date_key'=>'20201124','noon_flag'=>2,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>8,'date_key'=>'20201128','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>8,'date_key'=>'20201213','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>8,'date_key'=>'20201213','noon_flag'=>2,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>8,'date_key'=>'20210101','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>8,'date_key'=>'20210102','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>8,'date_key'=>'20210103','noon_flag'=>1,'comment'=>'']);
        WorkerSchedule::create(['worker_id'=>8,'date_key'=>'20210103','noon_flag'=>2,'comment'=>'']);

    }
}
