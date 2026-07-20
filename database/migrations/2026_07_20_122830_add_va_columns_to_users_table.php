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
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('onboarded_at')->nullable()->after('email_verified_at');
            $table->json('va_skills')->nullable()->after('onboarded_at');
            $table->string('va_motivation')->nullable()->after('va_skills');
            $table->string('va_challenge')->nullable()->after('va_motivation');
            $table->boolean('needs_scaffolding')->default(false)->after('va_challenge');
            $table->unsignedInteger('xp')->default(0)->after('needs_scaffolding');
            $table->unsignedSmallInteger('current_streak')->default(0)->after('xp');
            $table->unsignedSmallInteger('longest_streak')->default(0)->after('current_streak');
            $table->date('last_pass_on')->nullable()->after('longest_streak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'onboarded_at',
                'va_skills',
                'va_motivation',
                'va_challenge',
                'needs_scaffolding',
                'xp',
                'current_streak',
                'longest_streak',
                'last_pass_on',
            ]);
        });
    }
};
