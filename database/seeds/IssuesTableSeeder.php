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
        \App\User::all()->each(function($user) {
            \App\Lane::all()->each(function($lane) use ($user) {
                create(\App\Issue::class, [
                    'user_id' => $user->id,
                    'lane_id' => $lane->id
                ], rand(5,20));
            });
        });
    }
}
