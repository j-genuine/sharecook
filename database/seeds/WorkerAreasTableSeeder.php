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
        WorkerArea::create(['id'=>12,'worker_id'=>5,'area_id'=>40,'priority_flag'=>0]);
        WorkerArea::create(['id'=>13,'worker_id'=>11,'area_id'=>26,'priority_flag'=>0]);
        WorkerArea::create(['id'=>5,'worker_id'=>2,'area_id'=>13,'priority_flag'=>0]);
        WorkerArea::create(['id'=>6,'worker_id'=>2,'area_id'=>14,'priority_flag'=>1]);
        WorkerArea::create(['id'=>10,'worker_id'=>4,'area_id'=>27,'priority_flag'=>0]);
        WorkerArea::create(['id'=>11,'worker_id'=>4,'area_id'=>28,'priority_flag'=>1]);
        WorkerArea::create(['id'=>14,'worker_id'=>11,'area_id'=>27,'priority_flag'=>1]);
        WorkerArea::create(['id'=>15,'worker_id'=>11,'area_id'=>29,'priority_flag'=>2]);
        WorkerArea::create(['id'=>19,'worker_id'=>12,'area_id'=>13,'priority_flag'=>0]);
        WorkerArea::create(['id'=>20,'worker_id'=>12,'area_id'=>11,'priority_flag'=>1]);
        WorkerArea::create(['id'=>21,'worker_id'=>12,'area_id'=>8,'priority_flag'=>2]);
        WorkerArea::create(['id'=>25,'worker_id'=>13,'area_id'=>8,'priority_flag'=>0]);
        WorkerArea::create(['id'=>26,'worker_id'=>13,'area_id'=>13,'priority_flag'=>1]);
        WorkerArea::create(['id'=>27,'worker_id'=>13,'area_id'=>1,'priority_flag'=>2]);
        WorkerArea::create(['id'=>30,'worker_id'=>14,'area_id'=>1,'priority_flag'=>0]);
        WorkerArea::create(['id'=>31,'worker_id'=>1,'area_id'=>1,'priority_flag'=>0]);
        WorkerArea::create(['id'=>32,'worker_id'=>1,'area_id'=>2,'priority_flag'=>1]);
        WorkerArea::create(['id'=>33,'worker_id'=>6,'area_id'=>23,'priority_flag'=>0]);
        WorkerArea::create(['id'=>34,'worker_id'=>6,'area_id'=>22,'priority_flag'=>1]);
        WorkerArea::create(['id'=>35,'worker_id'=>6,'area_id'=>21,'priority_flag'=>2]);
        WorkerArea::create(['id'=>36,'worker_id'=>7,'area_id'=>4,'priority_flag'=>0]);
        WorkerArea::create(['id'=>37,'worker_id'=>7,'area_id'=>3,'priority_flag'=>1]);
        WorkerArea::create(['id'=>38,'worker_id'=>7,'area_id'=>7,'priority_flag'=>2]);
        WorkerArea::create(['id'=>39,'worker_id'=>8,'area_id'=>47,'priority_flag'=>0]);
        WorkerArea::create(['id'=>40,'worker_id'=>8,'area_id'=>48,'priority_flag'=>1]);
        WorkerArea::create(['id'=>47,'worker_id'=>9,'area_id'=>14,'priority_flag'=>0]);
        WorkerArea::create(['id'=>48,'worker_id'=>9,'area_id'=>13,'priority_flag'=>1]);
        WorkerArea::create(['id'=>49,'worker_id'=>9,'area_id'=>10,'priority_flag'=>2]);
        WorkerArea::create(['id'=>50,'worker_id'=>10,'area_id'=>34,'priority_flag'=>0]);
        WorkerArea::create(['id'=>51,'worker_id'=>10,'area_id'=>33,'priority_flag'=>1]);
        WorkerArea::create(['id'=>52,'worker_id'=>10,'area_id'=>38,'priority_flag'=>2]);
        WorkerArea::create(['id'=>56,'worker_id'=>3,'area_id'=>11,'priority_flag'=>0]);
        WorkerArea::create(['id'=>57,'worker_id'=>3,'area_id'=>12,'priority_flag'=>1]);
        WorkerArea::create(['id'=>58,'worker_id'=>3,'area_id'=>13,'priority_flag'=>2]);
        WorkerArea::create(['id'=>65,'worker_id'=>15,'area_id'=>40,'priority_flag'=>0]);
        WorkerArea::create(['id'=>66,'worker_id'=>15,'area_id'=>35,'priority_flag'=>1]);
        WorkerArea::create(['id'=>67,'worker_id'=>15,'area_id'=>34,'priority_flag'=>2]);
    }
}
