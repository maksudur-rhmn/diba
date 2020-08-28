<?php

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
        $roleAdmin =  Role::create(['name' => 'Admin']);

        $roleAdmin->givePermissionTo(['view', 'edit', 'delete']);

        $roleEditor =  Role::create(['name' => 'Editor']);

        $roleEditor->givePermissionTo(['view', 'edit']);

        $roleModerator =  Role::create(['name' => 'Moderator']);

        $roleModerator->givePermissionTo(['view', 'delete']);

        $roleUser = Role::create(['name' => 'User']);

        $roleUser->givePermissionTo('view');
    }
}
