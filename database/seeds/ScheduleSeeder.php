<?php

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
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
        foreach(range(1, 65) as $i) {            
            Schedule::create([
                'purpose'           => $faker->word,
                'details'           => $faker->text,
                'doctor'            => Doctor::inRandomOrder()->first()->id,
                'patient'           => Patient::inRandomOrder()->first()->id,
                'created_by'        => factory(App\Models\User::class)->create()->id,
                'date'              => $faker->dateTimeBetween($startDate = '-6 months', $max = '+2 months'),
                'time'              => $faker->time($format = 'H:00', $max = 'now')
            ]);
        }
    }
}
