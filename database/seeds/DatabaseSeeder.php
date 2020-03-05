<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
         factory(App\User::class, 1)->create();
         factory(App\Grade::class, 12)->create();
    }
  
}
