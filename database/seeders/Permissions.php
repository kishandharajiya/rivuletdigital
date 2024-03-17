<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class Permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'task-list',
            'task-create',
            'task-edit',
            'task-delete',
            'assign-task',
            'change-task-status'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }
  
    }
}
