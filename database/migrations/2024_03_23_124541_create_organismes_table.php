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
        Schema::create('organismes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('dirigant')->nullable();
            $table->string('institution')->nullable();
            $table->string('size')->nullable();
            $table->string('slug')->nullable();
            $table->string('views_count')->default("0"); 
            $table->string('downloads_count')->default("0");
            $table->mediumText('description')->nullable();
            $table->mediumText('content')->nullable();
            $table->enum('type', ['document','text'])->default('text');
            $table->foreignId('user_id')->constrained();
            $table->date('created_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organismes');
    }
};
