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
        Schema::create('employment_status_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employment_question_ID')->constrained('employment_questions')->onDelete('cascade'); 
            $table->foreignId('employment_status_ID')->constrained('employment_statuses')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment__status__questions');
    }
};
