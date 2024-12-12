<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use Faker\Factory as Faker;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            Contact::create([
                'name' => $faker->name,
                'phone' => $faker->numerify('9########'),
                'email' => $faker->unique()->safeEmail,
            ]);
        }
    }
}
