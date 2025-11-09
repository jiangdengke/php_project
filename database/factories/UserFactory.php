<?php

/**
 * 用户模型的工厂类：用于生成测试或填充数据库所需的用户假数据。
 */

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     *
     * 复用加密后的密码，避免对同一密码重复哈希。
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(), // 随机姓名。
            'email' => fake()->unique()->safeEmail(), // 唯一邮箱，避免冲突。
            'email_verified_at' => now(), // 默认标记为已验证。
            'password' => static::$password ??= Hash::make('password'), // 复用统一的密码哈希。
            'remember_token' => Str::random(10), // 记住登录令牌。
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * 通过状态转换将 email_verified_at 置空。
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
