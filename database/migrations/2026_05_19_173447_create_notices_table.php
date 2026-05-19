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
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');

            $table->string('category')->nullable();
            // Academic, Exam, Lab etc.

            $table->enum('priority', ['low', 'normal', 'high', 'urgent'])
                ->default('normal');

            $table->boolean('is_published')->default(false);

            $table->timestamp('expire_at')->nullable();

            $table->boolean('is_scrolling')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
