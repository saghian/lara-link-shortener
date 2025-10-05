<?php

namespace Database\Factories;

use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\link>
 */
class LinkFactory extends Factory
{
    protected $model = Link::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'main_link' => $this->faker->url(),
            'short_link' => Str::random(6),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(10),
            'click_count' => $this->faker->numberBetween(0, 100),
            'unique_click_count' => $this->faker->numberBetween(0, 80),
            'is_active' => $this->faker->boolean(90), // 90% فعال
            'is_private' => $this->faker->boolean(20), // 20% خصوصی
            'password' => $this->faker->boolean(10) ? bcrypt('password') : null,
            'expires_at' => $this->faker->boolean(30) ? now()->addDays($this->faker->numberBetween(1, 365)) : null,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
