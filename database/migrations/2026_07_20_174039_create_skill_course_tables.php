<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * The per-skill "upload and grade" course subsystem: a catalog of courses,
     * each an easy->hard ladder of lessons where the learner uploads a real
     * deliverable that Claude grades against a server-only rubric.
     */
    public function up(): void
    {
        Schema::create('skill_courses', function (Blueprint $table) {
            $table->id();
            $table->string('skill_key')->unique();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('icon')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->string('source')->default('ai');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('skill_lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_course_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('order');
            $table->string('title');
            $table->text('brief');
            // Server-only grading criteria — never sent to the client.
            $table->json('rubric');
            $table->text('reference_notes')->nullable();
            $table->json('accepted_formats');
            $table->string('difficulty')->default('easy');
            $table->unsignedInteger('xp_reward')->default(100);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->unique(['skill_course_id', 'order']);
        });

        Schema::create('skill_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('skill_lesson_id')->constrained()->cascadeOnDelete();
            $table->string('format');
            $table->text('body_text')->nullable();
            $table->string('file_path')->nullable();
            $table->string('link_url')->nullable();
            $table->string('submission_hash', 64)->nullable();
            $table->string('status')->default('queued');
            $table->unsignedTinyInteger('ai_score')->nullable();
            $table->boolean('ai_passed')->nullable();
            $table->json('ai_strengths')->nullable();
            $table->json('ai_fixes')->nullable();
            $table->text('ai_next_step')->nullable();
            $table->string('model')->nullable();
            $table->timestamp('graded_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'skill_lesson_id']);
            $table->index(['skill_lesson_id', 'submission_hash']);
        });

        Schema::create('user_skill_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('skill_course_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('current_lesson_order')->default(1);
            $table->string('status')->default('in_progress');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'skill_course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_skill_progress');
        Schema::dropIfExists('skill_submissions');
        Schema::dropIfExists('skill_lessons');
        Schema::dropIfExists('skill_courses');
    }
};
