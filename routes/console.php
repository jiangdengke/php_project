<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// 注册一个自定义的 Artisan 命令，可在命令行中运行。
Artisan::command('inspire', function () {
    // 输出一条随机励志语句到控制台。
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
