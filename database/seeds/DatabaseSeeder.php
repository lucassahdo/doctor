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
        $this->call(UserSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(AttendantSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(ScheduleSeeder::class);
    }
}
