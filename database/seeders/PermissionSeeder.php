<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [
            'create product',
            'view product',
            'view products',
            'delete product',
            'edit product',
            'create user',
            'view user',
            'view users',
            'delete user',
            'edit user',
            'create purchase',
            'view purchase',
            'view purchases',
            'delete purchase',
            'edit purchase',
            'create sale',
            'view sale',
            'view sales',
            'delete sale',
            'edit sale',
            'create client',
            'view client',
            'view clients',
            'delete client',
            'edit client',
            'create category',
            'view category',
            'delete category',
            'create warehouse',
            'view warehouse',
            'view warehouses',
            'delete warehouse',
            'edit warehouse',
            'edit stock',
            'empty stock',
            'view stock',
            'create role',
            'view roles',
            'view role',
            'delete role',
            'edit role',
            'edit ticket',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
