<?php

use App\Models\Profession;
use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
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

        factory(Profession::class, 17)->create();
    }
}
