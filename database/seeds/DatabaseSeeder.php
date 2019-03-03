<?php

use Illuminate\Database\Seeder;
use App\Mission;
use App\User;
use App\Work;
use App\Step;
use App\Status;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 1)->create();
        factory(Mission::class, 3)->create();
        factory(Step::class, 3)->create();
        factory(Status::class, 3)->create();
        factory(Work::class, 5)->create();
    }
}
