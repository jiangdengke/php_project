<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * 文件作用：描述应用的用户实体模型，封装认证相关字段和行为。
 */
/**
 * 用户模型：对应数据库中的 users 表。
 * 继承 Authenticatable，使其可以参与 Laravel 的身份认证流程。
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $avatar
 * @property string|null $experience
 * @property string|null $skills
 * @property int $privilege 0:普通成员 1:管理员
 * @property int $login_status 0:正常登录 1:禁止登录
 * @property \Illuminate\Support\Carbon|null $last_login_time
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastLoginTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLoginStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePrivilege($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    /**
     * 这是 PHP trait，用于给模型扩展功能。HasFactory 让你可以使用 User::factory() 生成测试数据；Notifiable 让用户模型具备
     * 发送通知（邮件、短信等）的能力。
     */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * 可批量赋值的字段列表。
     *
     */
    /**
     * $fillable  定义了“允许批量赋值”的字段，防止 User::create($request->all()) 时写入未授权的列。这里允许
     * name、email、password。
 */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'experience',
        'skills',
        'privilege',
        'login_status',
        'last_login_time',
    ];

    /**
     * 序列化（如转换成数组或 JSON）时需要隐藏的字段。
     *
     * @var list<string>
     */
    /**
     * $hidden 定义了默认从模型序列化输出时要隐藏的字段，防止 password、remember_token 在返回 JSON 时
     * 泄露。
 */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * 定义需要做类型转换的字段。
     * 使用类型转换可以让 Eloquent 自动将数据库值转换成合适的 PHP 类型。
     *
     * @return array<string, string>
     */
    /**
     * 这是 Eloquent 的类型转换机制。返回的数组告知 Laravel：
     * - email_verified_at 按 datetime 处理，取出来就是 Carbon 对象；
     * - password 标记为 hashed，意味着赋值时自动调用 Hash::make()，避免手动加密。
     * 通过 casts，数据库里的值在读写时会自动转换为合适的 PHP 类型或进行额外处理。
     */
    /**
     *Carbon 是 Laravel 默认引入的日期时间处理库（nesbot/carbon），在代码里常以 Carbon\Carbon 类出现。它在 PHP 原生 DateTime
     * 基础上扩展了大量便捷方法，比如 now(), addDays(), format('Y-m-d'), diffForHumans() 等。Laravel 的 datetime 类型字段会自
     * 动转换成 Carbon 对象，所以你可以直接对模型的日期属性调用这些方法，如 $user->email_verified_at->diffForHumans()。
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_time' => 'datetime',
            'privilege' => 'integer',
            'login_status' => 'integer',
            'password' => 'hashed',
        ];
    }
}
