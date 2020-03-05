<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
<<<<<<< HEAD
    public function run(){
        factory(App\User::class, 1)->create();
=======
    public function run()
    {
         factory(App\User::class, 1)->create();
         factory(App\Grade::class, 12)->create();
>>>>>>> 2a7e57582ab4ab6d35ea1978c370acdad37d00fb
    }
  
}
