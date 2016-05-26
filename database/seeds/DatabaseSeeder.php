<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Project')->insert([
                'name' => 'Attendence System'
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
