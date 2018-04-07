<?php

use Illuminate\Database\Seeder;

class IssuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        create(\App\Issue::class, ['user_id' => 1], rand(2, 10));
        create(\App\Issue::class, ['user_id' => 2], rand(2, 10));
    }
}
