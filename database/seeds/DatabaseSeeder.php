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
        
        DB::table('Project')->insert([
                'name' => 'Tomato Storage'
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
