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
        // Drop the table
        // Schema::dropIfExists('employment_questions');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optionally, you can recreate the table if needed
        // Schema::create('table_name', function (Blueprint $table) {
        //     $table->id();
        //     // Other columns...
        // });
    }
};
