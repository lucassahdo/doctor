<?php

use Illuminate\Database\Seeder;
use App\Models\Attendant;
use App\Models\User;
use Faker\Factory as Faker;

class AttendantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendants')->delete();
        $faker = Faker::create();
        echo "[Seed] Table 'attendants'\n";
        foreach(range(1, 8) as $i) {
            Attendant::create([
                'name'              => $faker->firstName,
                'lastname'          => $faker->lastName,
                'user'              => factory(App\Models\User::class)->create()->id,
                'cep'               => $faker->numerify('#####-###'),
                'street'            => $faker->streetName,
                'number'            => $faker->buildingNumber(),
                'district'          => $faker->word,
                'state'             => $faker->state,
                'city'              => $faker->city,
                'cellphone'         => $faker->numerify('(##) #####-####'),
                'phone'             => $faker->numerify('(##) ####-####'),
                'email'             => $faker->companyEmail
            ]);
        }
    }
}
