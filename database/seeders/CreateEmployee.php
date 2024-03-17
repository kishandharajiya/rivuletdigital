<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateEmployee extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Employee',
            'email' => 'employee@yopmail.com',
            'password' => bcrypt('123456')
        ]);

        $role = Role::where(['name' => 'employee'])->first();
        $permissionsArr = [
            'task-list',
            'task-create',
            'task-edit',
            'task-delete'
        ];
        $permissions = Permission::whereIn('name',$permissionsArr)->pluck('id', 'id')->all();
    
        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
