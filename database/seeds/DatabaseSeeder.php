<?php

use Illuminate\Database\Seeder;
use App\Mission;
use App\User;
use App\Note;
use App\Work;

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
        factory(Mission::class, 1)->create();
        factory(Note::class, 2)->create();
        factory(Work::class, 2)->create();
    }
}
