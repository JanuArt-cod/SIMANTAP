<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('welcome_title')->nullable()->after('address');
            $table->text('welcome_text')->nullable()->after('welcome_title');
            $table->string('welcome_image')->nullable()->after('welcome_text');
            $table->integer('posts_limit')->default(3)->after('welcome_image');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['welcome_title', 'welcome_text', 'welcome_image', 'posts_limit']);
        });
    }
};