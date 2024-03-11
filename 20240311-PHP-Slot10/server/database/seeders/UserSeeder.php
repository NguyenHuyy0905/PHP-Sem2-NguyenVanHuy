<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super = User::create([
            'email' => 'admin1@gmail.com',
            'name' => 'admin1',
            'password' => \Hash::make('123456'),
        ]);

        // $permissions = Permission::pluck('id', 'id')->all();
        // $role->syncPermissions($permissions);
        $super->assignRole('super-admin');

        $admin = User::create([
            'email' => 'admin2@gmail.com',
            'name' => 'admin2',
            'password' => \Hash::make('123456'),
        ]);

        $admin->assignRole('admin');
        Permission::findById(1);
    }
}
