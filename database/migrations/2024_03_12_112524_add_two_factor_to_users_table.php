<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('two_factor_enabled')->default(false);
            $table->integer('login_attempts')->default(0);
            $table->datetime('last_login_at')->nullable();
            $table->integer('two_factor_code')->nullable();
            $table->datetime('two_factor_expires_at')->nullable();
            $table->integer('can_login')->default(1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('two_factor_enabled');
            $table->dropColumn('last_login_at');
            $table->dropColumn('two_factor_expires_at');
            $table->dropColumn('can_login');
            $table->dropColumn('login_attempts');
            $table->dropColumn('two_factor_code');
        });
    }
};
