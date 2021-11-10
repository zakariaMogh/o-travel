<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Laravel\Sanctum\PersonalAccessToken;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Start inserting users');
        $user = User::factory(1)->create([
            'phone' => 774857141,
            'email' => 'user@app.com',
            'password' => bcrypt('password'),
            'country_code' => 213,
                ]
        );
        PersonalAccessToken::create([
            'tokenable_id' => $user[0]->id,
            'tokenable_type' => 'App\Models\User',
            'name' => '0500000000',
            'token' => 'b1db40926b5d95a03ff784c364db0d0143d71eea88f4bd6140013053cbbb4de6', // 2|YxxlWvDqct79Mh6XrC6oizPutKO1Y77HQWQLZAff
            'abilities' => '["*"]'
        ]);
        User::factory(20)->create();
        $this->command->info('users was inserted Successfully');
    }
}
