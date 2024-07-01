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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->mediumText('description')->nullable();
            $table->mediumText('content')->nullable();
            $table->string('location')->nullable();
            $table->string('slug')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('time')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('ministre_id')->nullable();
            $table->foreignId('category_agenda_id')->nullable();
            $table->enum('type', ['ministre', 'ministere']);
            $table->softDeletes();
            $table->enum('status', ['isPublished' , 'isDraft', 'isPlanned', 'isUpdated'])->default('isPublished');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
