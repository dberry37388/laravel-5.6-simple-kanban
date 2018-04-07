<?php

use Illuminate\Database\Seeder;

class LanesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        create(\App\Lane::class, ['title' => 'Todo', 'user_id' => 1]);
        create(\App\Lane::class, ['title' => 'In Progress', 'user_id' => 1]);
        create(\App\Lane::class, ['title' => 'Done', 'user_id' => 2]);
    }
}
