<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperadminUserSeeder extends Seeder
{
    /**
     * Seed the initial Superadmin user and assign the Superadmin role.
     *
     * Reads credentials from .env (SUPERADMIN_NAME / SUPERADMIN_EMAIL /
     * SUPERADMIN_PASSWORD) and falls back to sensible defaults if unset.
     */
    public function run(): void
    {
        $name = env('SUPERADMIN_NAME', 'Super Admin');
        $email = env('SUPERADMIN_EMAIL', 'superadmin@example.com');
        $password = env('SUPERADMIN_PASSWORD', 'password');

        $user = User::firstOrNew(['email' => $email]);
        $user->name = $name;
        $user->password = Hash::make($password);
        $user->email_verified_at = $user->email_verified_at ?? now();
        $user->save();

        $user->assignRole('Superadmin');
    }
}
