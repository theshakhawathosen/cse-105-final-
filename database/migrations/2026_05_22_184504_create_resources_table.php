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
        Schema::create('resources', function (Blueprint $table) {

            $table->id();

            $table->string('title');

            $table->foreignId('subject_id')
                ->constrained('subjects')
                ->onDelete('cascade');

            $table->enum('category', [
                'notes',
                'slides',
                'book',
                'lab_manual',
                'assignment_solution',
                'question_bank',
                'tutorial',
                'others',
            ]);

            $table->string('link')->nullable();

            $table->boolean('is_published')
                ->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
