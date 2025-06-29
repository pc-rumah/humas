<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $petugasRole = Role::firstOrCreate(['name' => 'petugas']);

        // 2. Buat User Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@humas.com'],
            [
                'name' => 'Admin Humas',
                'password' => bcrypt('password'),
            ]
        );
        $admin->assignRole($adminRole);

        $petugas = User::firstOrCreate(
            ['email' => 'petugas@humas.com'],
            [
                'name' => 'Petugas Humas',
                'password' => bcrypt('password'),
            ]
        );
        $petugas->assignRole($petugasRole);

        $this->command->info('Seeder Role & User Berhail');
    }
}
