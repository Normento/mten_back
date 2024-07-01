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
        Schema::table('opportunites', function (Blueprint $table) {
            // Add the column for the foreign key
            $table->foreignId('category_opportunity_id');

            // Define the foreign key constraint
            $table->foreign('category_opportunity_id')
                ->references('id')
                ->on('category_opportunities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('opportunites', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['category_opportunity_id']);

            // Drop the column
            $table->dropColumn('category_opportunity_id');
        });
    }
};
