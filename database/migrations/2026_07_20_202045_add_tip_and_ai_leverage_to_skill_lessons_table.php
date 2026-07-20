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
        Schema::table('skill_lessons', function (Blueprint $table) {
            // Learner-facing (unlike rubric/reference_notes): a coaching tip and
            // a "how to leverage AI" approach plus a copyable starter prompt.
            $table->text('tip')->nullable()->after('xp_reward');
            $table->json('ai_leverage')->nullable()->after('tip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skill_lessons', function (Blueprint $table) {
            $table->dropColumn(['tip', 'ai_leverage']);
        });
    }
};
