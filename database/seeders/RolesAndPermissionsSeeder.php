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

        // Create permissions
        Permission::create(['name' => 'create customer']);
        Permission::create(['name' => 'edit customer']);
        Permission::create(['name' => 'delete customer']);
        Permission::create(['name' => 'view customer']);

        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'view users']);

        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'edit roles']);
        Permission::create(['name' => 'delete roles']);
        Permission::create(['name' => 'view roles']);

        Permission::create(['name' => 'feature status']);
        Permission::create(['name' => 'view features']);

        // Create roles and assign permissions
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

        $dmcrole = Role::create(['name' => 'Dmc']);
        $dmcrole->givePermissionTo('create users');
        $dmcrole->givePermissionTo('edit users');
        $dmcrole->givePermissionTo('delete users');
        $dmcrole->givePermissionTo('view users');

        $dmcrole->givePermissionTo('create customer');
        $dmcrole->givePermissionTo('edit customer');
        $dmcrole->givePermissionTo('delete customer');
        $dmcrole->givePermissionTo('view customer');

        $agentrole = Role::create(['name' => 'Agent']);
        $agentrole->givePermissionTo('create customer');
        $agentrole->givePermissionTo('edit customer');
        $agentrole->givePermissionTo('delete customer');
        $agentrole->givePermissionTo('view customer');

        
    }
}
