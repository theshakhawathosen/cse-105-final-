<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('online_classes', function (Blueprint $table) {

            $table->id();

            $table->foreignId('subject_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('platform', [
                'Zoom',
                'Google Meet'
            ]);

            $table->string('meeting_link')->nullable();

            $table->date('date');

            $table->time('time');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('online_classes');
    }
};
