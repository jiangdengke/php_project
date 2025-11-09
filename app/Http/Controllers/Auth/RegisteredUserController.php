<?php

namespace App\Http\Controllers\Auth;

use App\Enums\ResponseCodeEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Jiannei\Response\Laravel\Support\Facades\Response;

class RegisteredUserController extends Controller
{
    /**
     * 处理注册请求并返回令牌。
     */
    public function store(Request $request): JsonResponse
    {
        // 验证基础信息：避免重复邮箱、弱密码或缺失字段。
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        // 借助 $fillable + password hashed casts 直接创建用户。
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'privilege' => 0,
            'login_status' => 0,
        ]);

        // 发行一个 Sanctum token，供前端后续的 Bearer 鉴权使用。
        $token = $user->createToken('api')->plainTextToken;

        return Response::success([
            'token' => $token,
            'user' => $user,
        ], '', ResponseCodeEnum::SERVICE_REGISTER_SUCCESS);
    }
}
