<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    /**
     * • - id: 主键，自增用户编号。
     * - name: 用户显示名称，可在后台成员列表、导航栏等位置展示。
     * - email: 登录账号/唯一凭证，用于认证、找回密码等（加上 unique() 保证不重复）。
     * - password: 经过哈希的登录密码（Laravel 默认 60 字符）。
     * - avatar: 头像文件路径，上传后保存在 public/uploads/...，界面可展示。
     * - experience: 文本字段，记录用户的经验说明（在设置页可填写“工作经验”等信息）。
     * - skills: 文本字段，记录技能描述，方便在个人设置页展示。
     * - privilege: 权限标识，0=普通成员（只能管理自己的监控），1=管理员（可管理成员、冻结账号等），并加索引便于查询。
     * - login_status: 登录状态，0=允许登录，1=禁止登录；管理员可切换这个值来封禁成员。
     * - last_login_time: 最后一次登录时间的字符串记录，成员列表中用于显示最近活动时间。
     * - rememberToken: Laravel 记住登录（“Remember me”）所需的 token。
     * - timestamps: 自动维护 created_at 和 updated_at，记录用户注册/更新时间。
 */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('avatar')->nullable();
            $table->string('experience')->nullable();
            $table->string('skills')->nullable();
            $table->integer('privilege')->default(0)->index()->comment('0:普通成员 1:管理员');
            $table->integer('login_status')->default(0)->index()->comment('0:正常登录 1:禁止登录');
            $table->string('last_login_time')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
