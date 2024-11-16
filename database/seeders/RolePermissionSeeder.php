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
        $permissions = [
            'manage categories',
            'manage companies',
            'manage company jobs',
            'manage candidates',
            'manage job applications',
            'manage employee',
            'manage employer'
        ];

        foreach($permissions as $permission){
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }

        $employeeRole = Role::firstOrCreate([
            'name' => 'employee'
        ]);

        $employerRole = Role::firstOrCreate([
            'name' => 'employer'
        ]);

        $adminRole = Role::firstOrCreate([
            'name' => 'admin'
        ]);

        $employeeRole->givePermissionTo([
            'manage job applications',
        ]);

        $employerRole->givePermissionTo([
            'manage company jobs',
            'manage candidates',
        ]);

        $adminRole->givePermissionTo(Permission::all());

        $firstAdmin = User::create([
            'name' => 'Ryuu Admin',
            'email' => 'ryuuadmin@gmail.com',
            'password' => bcrypt('12345678'),
            'occupation' => 'Admin',
            'experience' => '5',
            'avatar' => 'https://i.pravatar.cc/150?img=12',
        ]);

        $firstAdmin->assignRole($adminRole);
    }
}
