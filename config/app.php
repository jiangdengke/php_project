<?php

/**
 * 配置应用级别的全局参数：名称、环境、时区、语言、密钥和维护模式等。
 * 这些值会在框架启动及运行过程中被频繁读取。
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application, which will be used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name needs to be displayed.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),
    // 应用名称：默认从环境变量 APP_NAME 读取，用于通知、页面标题等位置。

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),
    // 应用运行环境：常见值如 local、production，用于区分配置和调试行为。

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),
    // 调试模式开关：开启后在出现错误时显示详细堆栈信息。

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | the application so that it's available within Artisan commands.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),
    // 应用的基础 URL：供 Artisan 等命令生成链接时使用。

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. The timezone
    | is set to "UTC" by default as it is suitable for most use cases.
    |
    */

    'timezone' => 'UTC',
    // 默认时区：影响 PHP 日期函数以及数据库时间处理。

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by Laravel's translation / localization methods. This option can be
    | set to any locale for which you plan to have translation strings.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),
    // 默认语言环境：决定翻译文件使用哪套语言。

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),
    // 备用语言环境：当找不到指定语言的翻译时退回到该语言。

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),
    // Faker 生成测试数据时使用的语言环境。

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is utilized by Laravel's encryption services and should be set
    | to a random, 32 character string to ensure that all encrypted values
    | are secure. You should do this prior to deploying the application.
    |
    */

    'cipher' => 'AES-256-CBC',
    // 加密算法：Laravel 默认采用 AES-256-CBC。

    'key' => env('APP_KEY'),
    // 应用加密密钥：需设置为随机 32 位字符串，保证加密安全性。

    'previous_keys' => [
        ...array_filter(
            explode(',', (string) env('APP_PREVIOUS_KEYS', ''))
        ),
    ],
    // 历史密钥列表：用于平滑轮换密钥，允许解密旧数据。

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],
    // 维护模式配置：可选 file 或 cache 驱动，实现多机共享的维护状态。

];
