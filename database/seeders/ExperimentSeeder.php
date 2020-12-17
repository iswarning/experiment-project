<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExperimentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for($i = 0; $i < 20; $i++) {
            \App\Models\Experiment::create([
                'name' => $faker->name(),
                'status' => 1,
                'active' => false,
                'datetime' => now(),
                'role' => 1,
            ]);
        }
    }
}
