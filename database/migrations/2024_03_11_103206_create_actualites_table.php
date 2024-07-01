<?php

use App\Models\CategoryActualite;
use App\Models\User;
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
        Schema::create('actualites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_actualite_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->mediumText('description')->nullable();
            $table->mediumText('slug')->nullable();
            $table->mediumText('content');
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
        Schema::dropIfExists('actualites');
    }
};
