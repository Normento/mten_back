<?php

use App\Models\Acteur;
use App\Models\CategoryActeur;
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
        Schema::create('acteurs', function (Blueprint $table) {
            $table->id();
            $table->string('sigle')->nullable();
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->string('slug')->nullable();
            $table->string('dirigant')->nullable();
            $table->mediumText('description')->nullable(); 
            $table->longText('content')->nullable();
            $table->foreignIdFor(User::class)->constrained();
            $table->softDeletes();
            $table->timestamps();
           });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acteurs');
    }
};
