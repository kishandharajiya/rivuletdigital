<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateManager extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           $user = User::create([
            'name' => 'Manager',
            'email' => 'manager@yopmail.com',
            'password' => bcrypt('123456')
        ]);

        $role = Role::where(['name' => 'manager'])->first();
        $permissionsArr = [
           'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'task-list',
            'assign-task',
            'change-task-status'
        ];
        $permissions = Permission::whereIn('name',$permissionsArr)->pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
