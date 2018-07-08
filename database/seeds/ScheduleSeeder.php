<?php

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Doctor;
use App\Models\Patient;
use Faker\Factory as Faker;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedules')->delete();
        $faker = Faker::create();
        echo "[Seed] Table 'schedules'\n";
        foreach(range(1, 200) as $i) {            
            Schedule::create([
                'doctor'            => Doctor::inRandomOrder()->first()->id,
                'patient'           => Patient::inRandomOrder()->first()->id,
                'date'              => $faker->date($format = 'Y-m-d', $max = 'now'),
                'time'              => $faker->time($format = 'H:i:s', $max = 'now'),
                'name'              => $faker->word,
                'description'       => $faker->text
            ]);
        }
    }
}
