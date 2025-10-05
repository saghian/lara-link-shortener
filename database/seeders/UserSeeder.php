<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ایجاد کاربر ادمین
        User::create([
            'name' => 'مدیر سیستم',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // ایجاد کاربر معمولی
        User::create([
            'name' => 'کاربر تست',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // ایجاد ۱۰ کاربر تصادفی
        User::factory(10)->create();

        $this->command->info('کاربران با موفقیت ایجاد شدند!');
        $this->command->info('ایمیل: admin@example.com | رمز: password');
        $this->command->info('ایمیل: user@example.com | رمز: password');
    }
}
