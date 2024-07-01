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
        Schema::create('opportunites', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->mediumText('description')->nullable();
            $table->longText('content')->nullable();
            $table->mediumText('structure_acceuil')->nullable();
            $table->string('views_count')->default("0");
            $table->string('downloads_count')->default("0");
            $table->integer('size')->nullable();
            $table->string('slug')->nullable();
            $table->enum('status', ['isOpenned' , 'isClosed'])->default('isOpenned');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opportunites');
    }
};
