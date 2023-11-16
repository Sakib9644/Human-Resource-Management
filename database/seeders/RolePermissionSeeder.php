<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'admin']);

        $permission = [
            ['name'=> 'user-list'],
            ['name'=> 'create-user'],
            ['name'=> 'edit-user'],
            ['name'=> 'delete-user'],
            ['name'=> 'role-list'],
            ['name'=> 'create-role'],
            ['name'=> 'edit-role'],
            ['name'=> 'delete-role'],

        ];

        foreach ($permission as $item){
            Permission::create($item);
        } 

        $role->syncPermissions(Permission::all());
        $user = User::first();

        $user->assignRole($role);
    }
}
