<?php

use Illuminate\Database\Seeder;
use App\Workers\WorkerArea;

class WorkerAreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkerArea::create(['worker_id'=>7,'area_id'=>47,'priority_flag'=>0]);
        WorkerArea::create(['worker_id'=>8,'area_id'=>13,'priority_flag'=>0]);
        WorkerArea::create(['worker_id'=>8,'area_id'=>14,'priority_flag'=>1]);
        WorkerArea::create(['worker_id'=>9,'area_id'=>11,'priority_flag'=>0]);
        WorkerArea::create(['worker_id'=>9,'area_id'=>13,'priority_flag'=>1]);
        WorkerArea::create(['worker_id'=>11,'area_id'=>28,'priority_flag'=>0]);
        WorkerArea::create(['worker_id'=>11,'area_id'=>27,'priority_flag'=>1]);
        WorkerArea::create(['worker_id'=>6,'area_id'=>13,'priority_flag'=>0]);
        WorkerArea::create(['worker_id'=>3,'area_id'=>1,'priority_flag'=>0]);
        WorkerArea::create(['worker_id'=>3,'area_id'=>2,'priority_flag'=>1]);
        WorkerArea::create(['worker_id'=>4,'area_id'=>27,'priority_flag'=>0]);
        WorkerArea::create(['worker_id'=>4,'area_id'=>26,'priority_flag'=>1]);
    }
}
