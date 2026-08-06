<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        User::updateOrCreate(
            ['email' => 'admin@sambongrejo.desa.id'],
            [
                'name'     => 'Administrator',
                'password' => Hash::make('Admin@Sambongrejo2025'),
                'role'     => 'super_admin',
            ]
        );

        // Admin Biasa (contoh)
        User::updateOrCreate(
            ['email' => 'operator@sambongrejo.desa.id'],
            [
                'name'     => 'Operator Desa',
                'password' => Hash::make('Operator@2025'),
                'role'     => 'admin',
            ]
        );
    }
}
