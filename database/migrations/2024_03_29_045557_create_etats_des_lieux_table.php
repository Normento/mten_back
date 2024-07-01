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
        Schema::create('etats_des_lieux', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->mediumText('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('size')->nullable();
            $table->enum('status', ['isPublished' , 'isDraft', 'isPlanned', 'isUpdated'])->default('isPublished');
            $table->enum('type', ['document','text'])->default('text');
            $table->foreignId('user_id');
            $table->string('slug')->nullable();
            $table->string('author')->nullable();
            $table->date('published_at')->nullable();
            $table->string('views_count')->default("0"); 
            $table->string('downloads_count')->default("0");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etat_des_lieuxes');
    }
};
