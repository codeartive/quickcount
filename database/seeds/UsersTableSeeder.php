<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	['name' => 'CODEARTIVE','email' => 'codeartive@gmail.com','password' => bcrypt('admin'),'role_id' => 1,'created_at' => Carbon::now(),'updated_at' => Carbon::now()],
        	['name' => 'SENO','email' => 'seno@gmail.com','password' => bcrypt('12345'),'role_id' => 2,'created_at' => Carbon::now(),'updated_at' => Carbon::now()],
        ]);
    }
}
