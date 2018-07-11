<?php

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use Faker\Factory as Faker;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctors')->delete();
        $faker = Faker::create();
        echo "[Seed] Table 'doctors'\n";
        foreach(range(1, 15) as $i) {
            Doctor::create([
                'name'              => $faker->firstName,
                'lastname'          => $faker->lastName,
                'user'              => factory(App\Models\User::class)->create()->id,               
                'function'          => $faker->jobTitle,
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
