<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Fortify\Contracts\PasskeyUser;
use Laravel\Fortify\PasskeyAuthenticatable;
use Laravel\Fortify\TwoFactorAuthenticatable;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property bool $is_admin
 * @property Carbon|null $onboarded_at
 * @property array<int, string>|null $va_skills
 * @property string|null $va_motivation
 * @property string|null $va_challenge
 * @property bool $needs_scaffolding
 * @property int $xp
 * @property int $current_streak
 * @property int $longest_streak
 * @property Carbon|null $last_pass_on
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property Carbon|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, UserTaskProgress> $taskProgress
 * @property-read Collection<int, TaskAttempt> $taskAttempts
 */
#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable implements PasskeyUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, PasskeyAuthenticatable, TwoFactorAuthenticatable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'is_admin' => 'boolean',
            'onboarded_at' => 'datetime',
            'va_skills' => 'array',
            'needs_scaffolding' => 'boolean',
            'last_pass_on' => 'date',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
        ];
    }

    /**
     * @return HasMany<UserTaskProgress, $this>
     */
    public function taskProgress(): HasMany
    {
        return $this->hasMany(UserTaskProgress::class);
    }

    /**
     * @return HasMany<TaskAttempt, $this>
     */
    public function taskAttempts(): HasMany
    {
        return $this->hasMany(TaskAttempt::class);
    }

    /**
     * Whether the user has completed onboarding.
     */
    public function hasOnboarded(): bool
    {
        return $this->onboarded_at !== null;
    }

    /**
     * Whether the user can access the admin QA tools.
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Whether the user has passed EVERY Foundation task. Skill courses stay
     * locked until the whole Foundation is finished (the 3 intro tasks alone
     * are not enough). Skipped tasks (existing VAs) count as passed. Returns
     * false when no Foundation tasks exist (locked by default).
     */
    public function hasCompletedFoundation(): bool
    {
        $total = Task::count();

        if ($total === 0) {
            return false;
        }

        $passed = $this->taskProgress()
            ->where('status', UserTaskProgress::STATUS_PASSED)
            ->count();

        return $passed === $total;
    }
}
