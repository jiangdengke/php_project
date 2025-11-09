<?php

use App\Enums\ResponseEnum;
use Jiannei\Enum\Laravel\Support\Enums\HttpStatusCode;

return [
    ResponseEnum::class => [
        HttpStatusCode::HTTP_OK->value => 'OK',
        HttpStatusCode::HTTP_UNAUTHORIZED->value => 'Unauthorized',

        ResponseEnum::SERVICE_REGISTER_SUCCESS->value => 'Register successfully',
        ResponseEnum::SERVICE_LOGIN_SUCCESS->value => 'Login successfully',

        ResponseEnum::SERVICE_REGISTER_ERROR->value => 'Register failed',
        ResponseEnum::SERVICE_LOGIN_ERROR->value => 'Login failed',

        ResponseEnum::CLIENT_PARAMETER_ERROR->value => 'Invalid parameters',
        ResponseEnum::CLIENT_CREATED_ERROR->value => 'Resource already exists',
        ResponseEnum::CLIENT_DELETED_ERROR->value => 'Resource not found',
        ResponseEnum::CLIENT_FORBIDDEN->value => 'Forbidden',

        ResponseEnum::SYSTEM_ERROR->value => 'Server error',
        ResponseEnum::SYSTEM_UNAVAILABLE->value => 'Service unavailable',
        ResponseEnum::SYSTEM_CACHE_CONFIG_ERROR->value => 'Cache config error',
        ResponseEnum::SYSTEM_CACHE_MISSED_ERROR->value => 'Cache missed',
        ResponseEnum::SYSTEM_CONFIG_ERROR->value => 'System config error',
    ],
];
