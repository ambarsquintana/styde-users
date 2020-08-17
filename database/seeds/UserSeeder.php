<?php

use App\Models\User;
use App\Models\Profession;
use Illuminate\Database\Seeder;

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

        factory(User::class)->create([
            'profession_id' => $professionId
        ]);

        factory(User::class, 48)->create();
    }
}
