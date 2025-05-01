<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

//use Spatie\Permission\PermissionRegistrar;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
       // Reset cache
       app()[PermissionRegistrar::class]->forgetCachedPermissions();
         $superAdminRole = Role::firstOrCreate(['name' => 'SuperAdmin']);
         $adminRole = Role::firstOrCreate(['name' => 'Admin']);
 
         
         $superAdmin = User::firstOrCreate([
             'email' => 'naceroumaima86@gmail.com'
         ], [
             'name' => 'Super Admin',
             'password' => bcrypt('oumaima2020'),
         ]);
         $superAdmin->assignRole($superAdminRole);
 
         
         $admin = User::firstOrCreate([
             'email' => 'admin@elyosdigital.tn'
         ], [
             'name' => 'Admin User',
             'password' => bcrypt('admin2025'),
         ]);
         $admin->assignRole($adminRole);
     }
    }

