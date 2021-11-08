<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PermissionSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CitySeeder::class);
        $this->call(DomainSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(UserSeeder::class);
//        $this->call(OfferSeeder::class);
    }
}
