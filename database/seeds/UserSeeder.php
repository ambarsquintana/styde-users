<?php

use App\User;
use App\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professionId = Profession::where('title', 'Back-end developer')->value('id');

        User::create([
            'name' => 'Ambar',
            'email' => 'ambarsquintana@gmail.com',
            'password' => bcrypt('123'),
            'profession_id' => $professionId,
            'is_admin' => true
        ]);

        User::create([
            'name' => 'Ruby',
            'email' => 'ruby@gmail.com',
            'password' => bcrypt('123'),
            'profession_id' => $professionId
        ]);

        User::create([
            'name' => 'Esmeralda',
            'email' => 'esmeralda@gmail.com',
            'password' => bcrypt('123'),
            'profession_id' => null
        ]);
    }
}
