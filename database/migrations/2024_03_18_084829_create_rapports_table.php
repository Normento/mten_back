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
        Schema::create('rapports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->mediumText('description');
            $table->longText('content')->nullable();
            $table->string('views_count')->default("0");
            $table->string('downloads_count')->default("0");
            $table->string('size')->nullable();
            $table->string('slug')->nullable();
            $table->string('secteur_activite')->nullable();
            $table->string('type_activite')->nullable();
            $table->string('institution')->nullable();
            $table->enum('status', ['isPublished' , 'isDraft', 'isPlanned', 'isUpdated'])->default('isPublished');
            $table->enum('type', ['document','text'])->default('text');
            $table->foreignId('category_rapport_id');
            $table->foreignId('user_id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapports');
    }
};
