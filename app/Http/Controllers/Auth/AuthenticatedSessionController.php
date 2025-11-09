<?php

namespace App\Http\Controllers\Auth;

use App\Enums\ResponseEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Jiannei\Response\Laravel\Support\Facades\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * 处理登录并返回访问令牌。
     */
    public function store(Request $request): JsonResponse
    {
        // 只收集登录所需字段，避免额外 payload 干扰验证。
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::query()->where('email', $credentials['email'])->first();

        // 邮箱不存在或密码校验失败时统一返回约定格式。
        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return Response::fail('邮箱或密码错误，请重新输入', ResponseEnum::SERVICE_LOGIN_ERROR);
        }

        // 后台可以禁用账号；此处额外校验 login_status 避免黑名单用户登录。
        if ($user->login_status !== 0) {
            return Response::fail('该账号已被加入黑名单，请联系管理员解除限制', ResponseEnum::CLIENT_FORBIDDEN);
        }

        // 记录最后登录时间，可用于风控或后台展示。
        $user->forceFill([
            'last_login_time' => now(),
        ])->save();

        // 登录成功后发放新的 token，让前端携带访问受保护 API。
        $token = $user->createToken('api')->plainTextToken;

        return Response::success([
            'token' => $token,
            'user' => $user,
        ], '', ResponseEnum::SERVICE_LOGIN_SUCCESS);
    }

    /**
     * 退出登录，删除当前访问令牌。
     */
    public function destroy(Request $request): JsonResponse
    {
        // 取出本次请求使用的 Sanctum 访问令牌；未认证时返回 null。
        // ?->的意思是在前面不返回null的情况下才调用currentAccessToken()
        $token = $request->user()?->currentAccessToken();

        // 仅删除当前访问 token，确保多端登录互不影响；如需全局登出可删除所有 tokens。
        if ($token) {
            $token->delete();
        }

        return Response::success([], '退出成功', ResponseEnum::SERVICE_LOGIN_SUCCESS);
    }
}
