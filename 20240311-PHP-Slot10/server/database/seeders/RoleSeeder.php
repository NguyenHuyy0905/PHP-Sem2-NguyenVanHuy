<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // app()['auth']->setDefaultDriver('api');
        $super = Role::create([
            'name' => 'super-admin',
            'guard_name' => 'api'
        ]);

        $permissions = Permission::pluck('id', 'id')->all();
        $super->syncPermissions($permissions);

        $admin = Role::create([
            'name' => 'admin',
            'guard_name' => 'api'
        ]);

        $adminPermission = Permission::pluck('id', 'id')->all();
        $admin->syncPermissions($adminPermission);
        $admin->revokePermissionTo('user-create');
    }
}
