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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key for users table
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('student_ID');
            $table->string('sex');
            $table->date('birthday');
            $table->integer('contact_number');
            $table->string('address');
            $table->string('civil_status');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string(column: 'status')->default('Active');
            $table->foreignId('course_ID')->constrained('courses')->onDelete('cascade'); // Foreign key for courses table
            $table->rememberToken();
            $table->timestamps();
            $table->engine = 'InnoDB'; // Ensure InnoDB engine for foreign keys
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
            $table->engine = 'InnoDB'; // Ensure InnoDB engine for this table
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index(); // Foreign key for user table
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
            $table->engine = 'InnoDB'; // Ensure InnoDB engine for this table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

