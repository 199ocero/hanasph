<?php

namespace App\Models;

use Database\Factories\UserTaskProgressFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property int $task_id
 * @property string $status
 * @property int $current_beat_order
 * @property int $attempts_count
 * @property bool $had_wrong_attempt
 * @property Carbon|null $passed_at
 * @property bool $skipped
 * @property string|null $reflection_note
 * @property Carbon|null $reflected_at
 * @property-read User $user
 * @property-read Task $task
 */
#[Fillable([
    'user_id',
    'task_id',
    'status',
    'current_beat_order',
    'attempts_count',
    'had_wrong_attempt',
    'passed_at',
    'skipped',
    'reflection_note',
    'reflected_at',
])]
class UserTaskProgress extends Model
{
    /** @use HasFactory<UserTaskProgressFactory> */
    use HasFactory;

    public const STATUS_LOCKED = 'locked';

    public const STATUS_UNLOCKED = 'unlocked';

    public const STATUS_PASSED = 'passed';

    protected $table = 'user_task_progress';

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'had_wrong_attempt' => 'boolean',
            'skipped' => 'boolean',
            'passed_at' => 'datetime',
            'reflected_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Task, $this>
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
