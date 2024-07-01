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
        Schema::create('reformes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->mediumText('description')->nullable(); 
            $table->string('author')->nullable(); 
            $table->longText('content')->nullable();
            $table->string('size')->nullable();
            $table->string('slug')->nullable();
            $table->string('views_count')->default("0"); 
            $table->string('downloads_count')->default("0");
            $table->enum('status', ['isPublished' , 'isDraft', 'isPlanned', 'isUpdated'])->default('isPublished');
            $table->enum('type', ['document','text'])->default('text');
            $table->foreignId('user_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reformes');
    }
};
