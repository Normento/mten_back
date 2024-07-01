<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('directions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('sigle')->nullable();
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->mediumText('content')->nullable();
            $table->string('director_name')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('category_direction_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('directions');
    }
};
