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
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->mediumText('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('slug')->nullable();
            $table->string('size')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('category_projet_id')->constrained();
            $table->enum('status', ['isPublished' , 'isDraft', 'isPlanned', 'isUpdated'])->default('isPublished');
            $table->enum('type', ['document','text'])->default('text');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('author')->nullable();
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
