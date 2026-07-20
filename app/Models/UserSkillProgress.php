<?php

namespace App\Models;

use Database\Factories\UserSkillProgressFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property int $skill_course_id
 * @property int $current_lesson_order
 * @property string $status
 * @property Carbon|null $completed_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable([
    'user_id',
    'skill_course_id',
    'current_lesson_order',
    'status',
    'completed_at',
])]
class UserSkillProgress extends Model
{
    /** @use HasFactory<UserSkillProgressFactory> */
    use HasFactory;

    protected $table = 'user_skill_progress';

    public const STATUS_IN_PROGRESS = 'in_progress';

    public const STATUS_COMPLETED = 'completed';

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'completed_at' => 'datetime',
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
     * @return BelongsTo<SkillCourse, $this>
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(SkillCourse::class, 'skill_course_id');
    }
}
