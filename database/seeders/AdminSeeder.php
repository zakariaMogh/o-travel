<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Create Default Account for admin with all permissions');
        $admin = Admin::create([
            'name' => 'Admin',
            'email'=> 'admin@app.com',
            'password' => bcrypt('password')
        ]);
//        $permissions = Permission::all();
//        $admin->givePermissionTo($permissions->all());
        $admin->assignRole('Super Admin');
        $this->command->info('Admin Account Has Been Created Successfully');
    }
}
