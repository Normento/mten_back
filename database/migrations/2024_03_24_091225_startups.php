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
        Schema::create('startups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('url')->nullable();
            $table->string('slug')->nullable();
            $table->string('promoteur')->nullable();
            $table->date('created_date')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('category_startup_id')->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('startups');
    }
};
