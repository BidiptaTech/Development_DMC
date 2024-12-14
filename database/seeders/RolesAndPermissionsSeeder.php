<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions with existence check
        if (!Permission::where('name', 'create customer')->exists()) {
            Permission::create(['name' => 'create customer']);
        }
        if (!Permission::where('name', 'edit customer')->exists()) {
            Permission::create(['name' => 'edit customer']);
        }
        if (!Permission::where('name', 'delete customer')->exists()) {
            Permission::create(['name' => 'delete customer']);
        }
        if (!Permission::where('name', 'view customer')->exists()) {
            Permission::create(['name' => 'view customer']);
        }

        if (!Permission::where('name', 'create users')->exists()) {
            Permission::create(['name' => 'create users']);
        }
        if (!Permission::where('name', 'edit users')->exists()) {
            Permission::create(['name' => 'edit users']);
        }
        if (!Permission::where('name', 'delete users')->exists()) {
            Permission::create(['name' => 'delete users']);
        }
        if (!Permission::where('name', 'view users')->exists()) {
            Permission::create(['name' => 'view users']);
        }

        if (!Permission::where('name', 'create roles')->exists()) {
            Permission::create(['name' => 'create roles']);
        }
        if (!Permission::where('name', 'edit roles')->exists()) {
            Permission::create(['name' => 'edit roles']);
        }
        if (!Permission::where('name', 'delete roles')->exists()) {
            Permission::create(['name' => 'delete roles']);
        }
        if (!Permission::where('name', 'view roles')->exists()) {
            Permission::create(['name' => 'view roles']);
        }

        if (!Permission::where('name', 'feature status')->exists()) {
            Permission::create(['name' => 'feature status']);
        }
        if (!Permission::where('name', 'view features')->exists()) {
            Permission::create(['name' => 'view features']);
        }

        // Create roles with existence check
        if (!Role::where('name', 'Admin')->exists()) {
            $adminRole = Role::create(['name' => 'Admin']);
            $adminRole->givePermissionTo('create users');
            $adminRole->givePermissionTo('edit users');
            $adminRole->givePermissionTo('delete users');
            $adminRole->givePermissionTo('view users');

            $adminRole->givePermissionTo('create customer');
            $adminRole->givePermissionTo('edit customer');
            $adminRole->givePermissionTo('delete customer');
            $adminRole->givePermissionTo('view customer');

            $adminRole->givePermissionTo('create roles');
            $adminRole->givePermissionTo('edit roles');
            $adminRole->givePermissionTo('delete roles');
            $adminRole->givePermissionTo('view roles');

            $adminRole->givePermissionTo('feature status');
            $adminRole->givePermissionTo('view features');
        }

        if (!Role::where('name', 'Dmc')->exists()) {
            $dmcrole = Role::create(['name' => 'Dmc']);
            $dmcrole->givePermissionTo('create users');
            $dmcrole->givePermissionTo('edit users');
            $dmcrole->givePermissionTo('delete users');
            $dmcrole->givePermissionTo('view users');

            $dmcrole->givePermissionTo('create customer');
            $dmcrole->givePermissionTo('edit customer');
            $dmcrole->givePermissionTo('delete customer');
            $dmcrole->givePermissionTo('view customer');
        }

        if (!Role::where('name', 'Agent')->exists()) {
            $agentrole = Role::create(['name' => 'Agent']);
            $agentrole->givePermissionTo('create customer');
            $agentrole->givePermissionTo('edit customer');
            $agentrole->givePermissionTo('delete customer');
            $agentrole->givePermissionTo('view customer');
        }
    }
}
