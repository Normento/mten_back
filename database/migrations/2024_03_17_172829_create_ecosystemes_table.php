<?php

use App\Models\CategoryEcosysteme;
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
        Schema::create('ecosystemes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->mediumText('description')->nullable();
            $table->longText('content')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignIdFor(CategoryEcosysteme::class);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecosystemes');
    }
};
