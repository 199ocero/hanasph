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
        Schema::create('user_task_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('task_id')->constrained()->cascadeOnDelete();
            $table->string('status')->default('locked');
            $table->unsignedTinyInteger('current_beat_order')->default(1);
            $table->unsignedSmallInteger('attempts_count')->default(0);
            $table->boolean('had_wrong_attempt')->default(false);
            $table->timestamp('passed_at')->nullable();
            $table->boolean('skipped')->default(false);
            $table->timestamps();

            $table->unique(['user_id', 'task_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_task_progress');
    }
};
