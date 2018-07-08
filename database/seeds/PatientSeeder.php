<?php

use Illuminate\Database\Seeder;
use App\Models\Patient;
use Faker\Factory as Faker;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patients')->delete();
        $faker = Faker::create();
        echo "[Seed] Table 'patients'\n";
        foreach(range(1, 200) as $i) {
            Patient::create([
                'name'              => $faker->firstName,
                'lastname'          => $faker->lastName,
                'jobtitle'          => $faker->jobTitle,
                'cep'               => $faker->numerify('#####-###'),
                'street'            => $faker->streetName,
                'district'          => $faker->word,
                'state'             => $faker->state,
                'city'              => $faker->city,
                'cellphone'         => $faker->numerify('(##) ####-####'),
                'phone'             => $faker->numerify('(##) #####-####'),
                'email'             => $faker->companyEmail
            ]);
        }
    }
}
