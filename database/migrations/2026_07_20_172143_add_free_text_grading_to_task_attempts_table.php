<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Makes task_attempts capable of recording free-text (AI-graded) attempts
     * alongside the existing multiple-choice ones. Existing rows keep mode='mc'
     * with their option_id set; free-text rows leave option_id null and mirror
     * ai_passed into is_correct so existing analytics/first-try queries keep
     * working unchanged.
     */
    public function up(): void
    {
        Schema::table('task_attempts', function (Blueprint $table) {
            $table->foreignId('option_id')->nullable()->change();

            $table->string('mode')->default('mc')->after('option_id');
            $table->text('reply_text')->nullable()->after('mode');
            $table->unsignedTinyInteger('ai_score')->nullable()->after('reply_text');
            $table->boolean('ai_passed')->nullable()->after('ai_score');
            $table->text('ai_feedback')->nullable()->after('ai_passed');
            $table->text('ai_suggested_reply')->nullable()->after('ai_feedback');
            $table->foreignId('matched_option_id')->nullable()->after('ai_suggested_reply')
                ->constrained('options')->nullOnDelete();
            $table->string('reply_hash', 64)->nullable()->after('matched_option_id');
            $table->string('model')->nullable()->after('reply_hash');
            $table->timestamp('graded_at')->nullable()->after('model');

            $table->index(['user_id', 'beat_id', 'reply_hash']);
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->boolean('ai_grading_enabled')->default(false)->after('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('ai_grading_enabled');
        });

        Schema::table('task_attempts', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'beat_id', 'reply_hash']);
            $table->dropConstrainedForeignId('matched_option_id');
            $table->dropColumn([
                'mode',
                'reply_text',
                'ai_score',
                'ai_passed',
                'ai_feedback',
                'ai_suggested_reply',
                'reply_hash',
                'model',
                'graded_at',
            ]);
            $table->foreignId('option_id')->nullable(false)->change();
        });
    }
};
