<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'email' => 'johndoe@example.org',
            'name' => 'John Doe'
        ]);

        factory(\App\User::class)->create([
            'email' => 'janedoe@example.org',
            'name' => 'Jane Doe'
        ]);
    }
}
