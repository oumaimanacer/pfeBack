<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        //$this->call([
           // UserSeeder::class,
           // EntrepriseSeeder::class,
           // EmployeSeeder::class,
        //]);
         // Création des rôles
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
             'email' => 'Oumeymabenafia@gmail.com'
         ], [
             'name' => 'Admin User',
             'password' => bcrypt('oumaima2025'),
         ]);
         $admin->assignRole($adminRole);
     }
    }

