<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    protected $permissions = [
        'edit-settings', 'view-settings',
        'create-admin', 'delete-admin', 'edit-admin', 'view-admin',
        'create-role', 'delete-role', 'edit-role', 'view-role',
        'create-category', 'delete-category', 'edit-category', 'view-category',
        'create-city', 'delete-city', 'edit-city', 'view-city',
        'create-country', 'delete-country', 'edit-country', 'view-country',
        'create-user', 'delete-user', 'edit-user', 'view-user',
        'create-domain', 'delete-domain', 'edit-domain', 'view-domain',
        'create-company', 'delete-company', 'edit-company', 'view-company',
        'create-offer', 'delete-offer', 'edit-offer', 'view-offer',
        'create-report', 'delete-report', 'edit-report', 'view-report',
        'create-admin-notification', 'delete-admin-notification', 'edit-admin-notification', 'view-admin-notification',

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->command->info('Start inserting admin permissions');
        config(['auth.defaults.guard' => 'admin']);
        foreach ($this->permissions as $p)
        {
            Permission::create([
                'name' => $p
            ]);
        }
        $this->command->info('permissions was inserted successfully');
        $this->command->info('Create Super Admin Role');

        $role = Role::create([
            'name' => 'Super Admin',
        ]);

        $this->command->info('Super Admin Role was created');


        $role->givePermissionTo(Permission::all()->all());
    }
}
