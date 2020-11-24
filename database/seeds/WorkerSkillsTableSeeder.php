<?php

use Illuminate\Database\Seeder;
use App\Workers\WorkerSkill;

class WorkerSkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkerSkill::create(['id'=>14,'worker_id'=>5,'skill_id'=>2,'priority_flag'=>0]);
        WorkerSkill::create(['id'=>15,'worker_id'=>5,'skill_id'=>3,'priority_flag'=>1]);
        WorkerSkill::create(['id'=>6,'worker_id'=>2,'skill_id'=>4,'priority_flag'=>0]);
        WorkerSkill::create(['id'=>7,'worker_id'=>2,'skill_id'=>5,'priority_flag'=>1]);
        WorkerSkill::create(['id'=>11,'worker_id'=>4,'skill_id'=>7,'priority_flag'=>0]);
        WorkerSkill::create(['id'=>12,'worker_id'=>4,'skill_id'=>9,'priority_flag'=>1]);
        WorkerSkill::create(['id'=>13,'worker_id'=>4,'skill_id'=>1,'priority_flag'=>2]);
        WorkerSkill::create(['id'=>16,'worker_id'=>5,'skill_id'=>7,'priority_flag'=>2]);
        WorkerSkill::create(['id'=>17,'worker_id'=>11,'skill_id'=>5,'priority_flag'=>0]);
        WorkerSkill::create(['id'=>18,'worker_id'=>11,'skill_id'=>4,'priority_flag'=>1]);
        WorkerSkill::create(['id'=>19,'worker_id'=>11,'skill_id'=>1,'priority_flag'=>2]);
        WorkerSkill::create(['id'=>22,'worker_id'=>12,'skill_id'=>1,'priority_flag'=>0]);
        WorkerSkill::create(['id'=>23,'worker_id'=>12,'skill_id'=>9,'priority_flag'=>1]);
        WorkerSkill::create(['id'=>27,'worker_id'=>13,'skill_id'=>4,'priority_flag'=>0]);
        WorkerSkill::create(['id'=>28,'worker_id'=>13,'skill_id'=>1,'priority_flag'=>1]);
        WorkerSkill::create(['id'=>29,'worker_id'=>13,'skill_id'=>8,'priority_flag'=>2]);
        WorkerSkill::create(['id'=>32,'worker_id'=>14,'skill_id'=>6,'priority_flag'=>0]);
        WorkerSkill::create(['id'=>33,'worker_id'=>1,'skill_id'=>1,'priority_flag'=>0]);
        WorkerSkill::create(['id'=>34,'worker_id'=>1,'skill_id'=>2,'priority_flag'=>1]);
        WorkerSkill::create(['id'=>35,'worker_id'=>1,'skill_id'=>3,'priority_flag'=>2]);
        WorkerSkill::create(['id'=>36,'worker_id'=>6,'skill_id'=>9,'priority_flag'=>0]);
        WorkerSkill::create(['id'=>37,'worker_id'=>6,'skill_id'=>1,'priority_flag'=>1]);
        WorkerSkill::create(['id'=>38,'worker_id'=>6,'skill_id'=>6,'priority_flag'=>2]);
        WorkerSkill::create(['id'=>39,'worker_id'=>7,'skill_id'=>1,'priority_flag'=>0]);
        WorkerSkill::create(['id'=>40,'worker_id'=>7,'skill_id'=>4,'priority_flag'=>1]);
        WorkerSkill::create(['id'=>41,'worker_id'=>7,'skill_id'=>7,'priority_flag'=>2]);
        WorkerSkill::create(['id'=>42,'worker_id'=>8,'skill_id'=>7,'priority_flag'=>0]);
        WorkerSkill::create(['id'=>43,'worker_id'=>8,'skill_id'=>2,'priority_flag'=>1]);
        WorkerSkill::create(['id'=>44,'worker_id'=>8,'skill_id'=>8,'priority_flag'=>2]);
        WorkerSkill::create(['id'=>49,'worker_id'=>9,'skill_id'=>8,'priority_flag'=>0]);
        WorkerSkill::create(['id'=>50,'worker_id'=>9,'skill_id'=>5,'priority_flag'=>1]);
        WorkerSkill::create(['id'=>51,'worker_id'=>10,'skill_id'=>1,'priority_flag'=>0]);
        WorkerSkill::create(['id'=>52,'worker_id'=>10,'skill_id'=>2,'priority_flag'=>1]);
        WorkerSkill::create(['id'=>56,'worker_id'=>3,'skill_id'=>4,'priority_flag'=>0]);
        WorkerSkill::create(['id'=>57,'worker_id'=>3,'skill_id'=>1,'priority_flag'=>1]);
        WorkerSkill::create(['id'=>58,'worker_id'=>3,'skill_id'=>8,'priority_flag'=>2]);
        WorkerSkill::create(['id'=>65,'worker_id'=>15,'skill_id'=>3,'priority_flag'=>0]);
        WorkerSkill::create(['id'=>66,'worker_id'=>15,'skill_id'=>7,'priority_flag'=>1]);
        WorkerSkill::create(['id'=>67,'worker_id'=>15,'skill_id'=>8,'priority_flag'=>2]);
    }
}
