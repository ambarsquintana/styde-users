<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Profession::create([
           'title' => 'Back-end developer'
        ]);

        Profession::create([
            'title' => 'Front-end developer'
        ]);

        Profession::create([
            'title' => 'Web developer'
        ]);

        Profession::factory()
            ->times(17)
            ->create();
    }
}
