<?php

/**
 * 第三方服务凭证配置，集中管理邮局、通知、云服务等外部服务的密钥。
 * 方便在代码中统一读取，避免散落在各处。
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        // Postmark 邮件服务 API 密钥。
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        // Resend 邮件服务 API 密钥。
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        // AWS SES 邮件服务访问凭证。
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            // Slack 机器人通知所需的 OAuth token 与默认频道。
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];
