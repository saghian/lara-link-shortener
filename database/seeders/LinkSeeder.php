<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // گرفتن کاربران
        $admin = User::where('email', 'admin@example.com')->first();
        $user = User::where('email', 'user@example.com')->first();

        // لینک‌های کاربر ادمین
        if ($admin) {
            Link::create([
                'user_id' => $admin->id,
                'main_link' => 'https://google.com',
                'short_link' => 'google',
                'title' => 'گوگل',
                'description' => 'موتور جستجوی گوگل',
                'click_count' => 150,
                'unique_click_count' => 120,
                'is_active' => true,
                'is_private' => false,
            ]);

            Link::create([
                'user_id' => $admin->id,
                'main_link' => 'https://github.com',
                'short_link' => 'github',
                'title' => 'گیت‌هاب',
                'description' => 'پلتفرم میزبانی کد',
                'click_count' => 80,
                'unique_click_count' => 65,
                'is_active' => true,
                'is_private' => true,
                'password' => bcrypt('123456'),
            ]);

            Link::create([
                'user_id' => $admin->id,
                'main_link' => 'https://laravel.com',
                'short_link' => 'laravel',
                'title' => 'لاراول',
                'description' => 'فریمورک PHP لاراول',
                'click_count' => 200,
                'unique_click_count' => 180,
                'is_active' => true,
                'is_private' => false,
                'expires_at' => now()->addDays(30),
            ]);
        }


        // لینک‌های کاربر معمولی
        if ($user) {
            Link::create([
                'user_id' => $user->id,
                'main_link' => 'https://youtube.com',
                'short_link' => 'youtube',
                'title' => 'یوتیوب',
                'description' => 'پلتفرم ویدیو',
                'click_count' => 50,
                'unique_click_count' => 40,
                'is_active' => true,
                'is_private' => false,
            ]);

            Link::create([
                'user_id' => $user->id,
                'main_link' => 'https://twitter.com',
                'short_link' => 'twitter',
                'title' => 'توییتر',
                'description' => 'شبکه اجتماعی توییتر',
                'click_count' => 30,
                'unique_click_count' => 25,
                'is_active' => false, // غیرفعال
                'is_private' => false,
            ]);
        }

        // ایجاد لینک‌های تصادفی برای همه کاربران
        $users = User::all();
        foreach ($users as $user) {
            Link::factory(5)->create([
                'user_id' => $user->id,
            ]);
        }

        $this->command->info('لینک‌های تست با موفقیت ایجاد شدند!');
    }
}
