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
        Schema::create('academic_configs', function (Blueprint $table) {
            $table->id();
            $table->integer('midterm_max')->default(30);
            $table->integer('final_max')->default(50);
            $table->integer('internal_max')->default(20);
            $table->decimal('yellow_threshold',5,2)->default(75);
            $table->decimal('red_threshold',5,2)->default(60);
            $table->decimal('marks_warning_threshold',5,2)->default(40);
            $table->integer('critical_subject_count')->default(3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_configs');
    }
};
