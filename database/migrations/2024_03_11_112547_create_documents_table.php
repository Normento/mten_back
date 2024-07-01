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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('size')->nullable(); 
            $table->text('description')->nullable();
            $table->mediumText('content')->nullable();
            $table->string('views_count')->default("0"); 
            $table->string('downloads_count')->default("0");
            $table->string('slug')->nullable();
            $table->foreignId('category_document_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->enum('status', ['isPublished' , 'isDraft', 'isPlanned', 'isUpdated'])->default('isPublished');
            $table->timestamps();
            $table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
