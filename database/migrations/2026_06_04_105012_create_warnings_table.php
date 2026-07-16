<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // FORCE DROP: Agar table galti se database me bachi ho, toh pehle use uda do!
        Schema::dropIfExists('warnings');

        Schema::create('warnings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('warning_type'); // e.g., 'attendance', 'academic', 'discipline'
            $table->string('severity_level'); // e.g., 'low', 'medium', 'critical'
            $table->text('reason');
            $table->date('issue_date');
            $table->foreignId('issued_by')->constrained('users')->onDelete('cascade');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warnings');
    }
};