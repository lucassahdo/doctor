<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder 
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        DB::table('users')->delete();            
        User::create([
            'name' => 'Heitor',
            'lastname' => 'Garcia',
            'email' => 'admin@doctor.com',
            'password'=> bcrypt('doctor@123'),
            'level'=> 3
        ]); 
    }
}
