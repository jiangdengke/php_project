<?php

namespace App\Http\Controllers;

use App\Models\User;

/**
 * 应用中所有 HTTP 控制器的基类，用于放置共享的中间件或帮助方法。
 */
abstract class Controller
{
    /**
     * 示例：演示如何在控制器中通过 Eloquent 与数据库交互。
     *
     * @param string $email
     * @return User|null
     */
    protected function exampleFindUserByEmail(string $email): ?User
    {
        // 直接调用模型查询 users 表，返回符合条件的第一条记录。
        return User::where('email', $email)->first();
    }
}
