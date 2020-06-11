<?php

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
        $professionId = DB::table('professions')
            ->where('title', 'Back-end developer')
            ->value('id');

        DB::table('users')->insert([
            'name' => 'Ambar',
            'email' => 'ambarsquintana@gmail.com',
            'password' => bcrypt('123'),
            'profession_id' => $professionId
        ]);
    }
}
