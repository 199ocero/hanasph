<?php

namespace App\Models;

use Database\Factories\TaskAttemptFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property int $task_id
 * @property int $beat_id
 * @property int|null $option_id
 * @property bool $is_correct
 * @property string $mode
 * @property string|null $reply_text
 * @property int|null $ai_score
 * @property bool|null $ai_passed
 * @property string|null $ai_feedback
 * @property string|null $ai_suggested_reply
 * @property int|null $matched_option_id
 * @property string|null $reply_hash
 * @property string|null $model
 * @property Carbon|null $graded_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable([
    'user_id',
    'task_id',
    'beat_id',
    'option_id',
    'is_correct',
    'mode',
    'reply_text',
    'ai_score',
    'ai_passed',
    'ai_feedback',
    'ai_suggested_reply',
    'matched_option_id',
    'reply_hash',
    'model',
    'graded_at',
])]
class TaskAttempt extends Model
{
    /** @use HasFactory<TaskAttemptFactory> */
    use HasFactory;

    public const MODE_MC = 'mc';

    public const MODE_FREE_TEXT = 'free_text';

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_correct' => 'boolean',
            'ai_passed' => 'boolean',
            'graded_at' => 'datetime',
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

    /**
     * The wrong option whose failure mode an AI-graded reply matched, if any.
     *
     * @return BelongsTo<Option, $this>
     */
    public function matchedOption(): BelongsTo
    {
        return $this->belongsTo(Option::class, 'matched_option_id');
    }
}
