<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();
        // permissions to products
        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'view product']);
        Permission::create(['name' => 'delete product']);

        // permissions to users
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'delete user']);

        // permissions to purchases
        Permission::create(['name' => 'create purchase']);
        Permission::create(['name' => 'view purchase']);
        Permission::create(['name' => 'delete purchase']);

        // permissions to sales
        Permission::create(['name' => 'create sale']);
        Permission::create(['name' => 'view sale']);
        Permission::create(['name' => 'delete sale']);

         // permissions to sales
         Permission::create(['name' => 'create client']);
         Permission::create(['name' => 'view client']);
         Permission::create(['name' => 'delete client']);
    }
}
