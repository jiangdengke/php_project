<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * 应用服务提供者：用于注册服务容器绑定、事件监听或应用启动时的初始化逻辑。
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * 在容器中绑定服务或单例。此处为空，按需扩展。
     */
    public function register(): void
    {
        // 可在此注册应用需要的服务、工具类等。
    }

    /**
     * Bootstrap any application services.
     *
     * 执行应用启动时需要运行的初始化代码。
     */
    public function boot(): void
    {
        // 可在此定义全局视图合成器、宏、事件监听等。
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/auth.php'));
    }
}
