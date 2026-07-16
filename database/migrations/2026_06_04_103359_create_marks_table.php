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
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()
            ->onDelete('cascade');
            $table->foreignId('subject_id')
            ->constrained()->onDelete('cascade');
            $table->enum('assessment_type',['midterm','final','internal']);
            $table->decimal('marks_obtained',6,2);
            $table->decimal('max_marks',6,2);
            $table->foreignId('entered_by')->constrained('users')
            ->onDelete('cascade');
            $table->timestamps();
            $table->unique(['student_id','subject_id','assessment_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};
