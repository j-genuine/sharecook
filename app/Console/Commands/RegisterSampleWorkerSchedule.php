<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Calendar\WorkerSchedule;

class RegisterSampleWorkerSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sampledata:workerschedule {days=30 : number of days ahead from today}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create 2 random records to schedules table of test workers(id:1~10 default date:30days ahead).';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //何日後かの指定（デフォルト30日後）
        $add_days = $this->argument("days");
        
        //テスト会員(ID:1~10)からランダムに、稼働スケジュールテーブルの指定日にレコードを2件作成する。
        for ($i = 0; $i < 2; $i++) {
            $worker_id = random_int(1,10);
            $date_key = date("Ymd",strtotime("+".$add_days." day"));
            $noon_flag = random_int(1,2);
            $ok_time = $noon_flag == 1 ? random_int(11,13) : random_int(18,20);
            $ok_time .= random_int(0,1) ? "時までOK" : "時以降OK";
            $comment = random_int(0,3) ? "" : $ok_time;
        
            WorkerSchedule::updateOrCreate([
                'worker_id' => $worker_id, 
                'date_key' => $date_key, 
                'noon_flag' => $noon_flag, 
                'comment' => $comment ], []
            );
        }
    }
}
