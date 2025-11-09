<?php

/**
 * 邮件配置：定义默认发件驱动、各类邮件传输器及全局发件人信息。
 * 发送通知、队列邮件等功能都会读取这里的设置。
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer that is used to send all email
    | messages unless another mailer is explicitly specified when sending
    | the message. All additional mailers can be configured within the
    | "mailers" array. Examples of each type of mailer are provided.
    |
    */

    // 默认使用的邮件驱动。
    'default' => env('MAIL_MAILER', 'log'),

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may configure all of the mailers used by your application plus
    | their respective settings. Several examples have been configured for
    | you and you are free to add your own as your application requires.
    |
    | Laravel supports a variety of mail "transport" drivers that can be used
    | when delivering an email. You may specify which one you're using for
    | your mailers below. You may also add additional mailers if needed.
    |
    | Supported: "smtp", "sendmail", "mailgun", "ses", "ses-v2",
    |            "postmark", "resend", "log", "array",
    |            "failover", "roundrobin"
    |
    */

    // 所有可用的邮件驱动及其专属参数。
    'mailers' => [

        'smtp' => [
            // 标准 SMTP 发送，支持自定义主机、端口、账号。
            'transport' => 'smtp',
            'scheme' => env('MAIL_SCHEME'),
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', '127.0.0.1'),
            'port' => env('MAIL_PORT', 2525),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url((string) env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
        ],

        'ses' => [
            // 亚马逊 SES 服务。
            'transport' => 'ses',
        ],

        'postmark' => [
            // Postmark 第三方邮件服务。
            'transport' => 'postmark',
            // 'message_stream_id' => env('POSTMARK_MESSAGE_STREAM_ID'),
            // 'client' => [
            //     'timeout' => 5,
            // ],
        ],

        'resend' => [
            // Resend 邮件服务。
            'transport' => 'resend',
        ],

        'sendmail' => [
            // 使用系统 sendmail 命令发送邮件。
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
        ],

        'log' => [
            // 将邮件写入日志文件，常用于调试。
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            // 将邮件保存在内存数组，适用于测试。
            'transport' => 'array',
        ],

        'failover' => [
            // 失败转移：按顺序尝试多个 mailer。
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
            'retry_after' => 60,
        ],

        'roundrobin' => [
            // 轮询方式：多个 mailer 轮流发送，提升可靠性。
            'transport' => 'roundrobin',
            'mailers' => [
                'ses',
                'postmark',
            ],
            'retry_after' => 60,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | You may wish for all emails sent by your application to be sent from
    | the same address. Here you may specify a name and address that is
    | used globally for all emails that are sent by your application.
    |
    */

    'from' => [
        // 全局发件邮箱与名称，可在单封邮件中覆盖。
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

];
