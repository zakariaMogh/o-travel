<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Laravel\Sanctum\PersonalAccessToken;
use Faker;
class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $this->command->info('Start inserting companies');
        $company = Company::factory(1)->create([
            'phone' => 770271561,
            'country_code' => 213,
            'wallet' => 10000,
            'codeC' => $faker->numberBetween($min = 1, $max = 250),
        ]);
        PersonalAccessToken::create([
            'tokenable_id' => $company[0]->id,
            'tokenable_type' => 'App\Models\Company',
            'name' => '0500000000',
            'token' => '83e972e8b3f99fdf4c4334e33d9f5f67bd3c2d1a91a71c141fdb233fa2283ed6', // 1|RWAWmX5q5GJYcZcaCgbZPu2W7JI6QsTtS3iF739F
            'abilities' => '["*"]'
        ]);
        Company::factory(20)->create();
        $this->command->info('companies was inserted Successfully');
    }
}
