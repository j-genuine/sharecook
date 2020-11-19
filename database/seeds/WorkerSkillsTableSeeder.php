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
        WorkerSkill::create(['worker_id'=>7,'skill_id'=>5,'priority_flag'=>0]);
        WorkerSkill::create(['worker_id'=>7,'skill_id'=>6,'priority_flag'=>1]);
        WorkerSkill::create(['worker_id'=>7,'skill_id'=>8,'priority_flag'=>2]);
        WorkerSkill::create(['worker_id'=>8,'skill_id'=>2,'priority_flag'=>0]);
        WorkerSkill::create(['worker_id'=>8,'skill_id'=>9,'priority_flag'=>1]);
        WorkerSkill::create(['worker_id'=>9,'skill_id'=>1,'priority_flag'=>0]);
        WorkerSkill::create(['worker_id'=>9,'skill_id'=>4,'priority_flag'=>1]);
        WorkerSkill::create(['worker_id'=>11,'skill_id'=>1,'priority_flag'=>0]);
        WorkerSkill::create(['worker_id'=>11,'skill_id'=>9,'priority_flag'=>1]);
        WorkerSkill::create(['worker_id'=>6,'skill_id'=>4,'priority_flag'=>0]);
        WorkerSkill::create(['worker_id'=>6,'skill_id'=>7,'priority_flag'=>1]);
        WorkerSkill::create(['worker_id'=>6,'skill_id'=>8,'priority_flag'=>2]);
        WorkerSkill::create(['worker_id'=>3,'skill_id'=>5,'priority_flag'=>0]);
        WorkerSkill::create(['worker_id'=>3,'skill_id'=>1,'priority_flag'=>1]);
        WorkerSkill::create(['worker_id'=>3,'skill_id'=>2,'priority_flag'=>2]);
        WorkerSkill::create(['worker_id'=>4,'skill_id'=>1,'priority_flag'=>0]);
        WorkerSkill::create(['worker_id'=>4,'skill_id'=>8,'priority_flag'=>1]);
    }
}
