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
        DB::table('users')->insert([
            'name' => 'Jonas',
            'email' => 'jon@jon.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
