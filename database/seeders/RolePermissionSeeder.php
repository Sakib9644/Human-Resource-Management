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
       

        $permission = [
            ['name' => 'user-list'],
            ['name' => 'create-user'],
            ['name' => 'edit-user'],
            ['name' => 'delete-user'],
            ['name' => 'role-list'],
            ['name' => 'create-role'],
            ['name' => 'edit-role'],
            ['name' => 'delete-role'],
            ['name' => 'profile-list'],
            ['name' => 'create-profile'],
            ['name' => 'edit-profile'],
            ['name' => 'delete-profile'],

        ];

        foreach ($permission as $item){
            Permission::create($item);
        } 

        
    }
}
