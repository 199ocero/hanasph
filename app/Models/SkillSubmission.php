<?php

namespace App\Models;

use Database\Factories\SkillSubmissionFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property int $skill_lesson_id
 * @property string $format
 * @property string|null $body_text
 * @property string|null $file_path
 * @property string|null $link_url
 * @property string|null $submission_hash
 * @property string $status
 * @property int|null $ai_score
 * @property bool|null $ai_passed
 * @property array<int, string>|null $ai_strengths
 * @property array<int, string>|null $ai_fixes
 * @property string|null $ai_next_step
 * @property string|null $model
 * @property Carbon|null $graded_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read SkillLesson $lesson
 */
#[Fillable([
    'user_id',
    'skill_lesson_id',
    'format',
    'body_text',
    'file_path',
    'link_url',
    'submission_hash',
    'status',
    'ai_score',
    'ai_passed',
    'ai_strengths',
    'ai_fixes',
    'ai_next_step',
    'model',
    'graded_at',
])]
class SkillSubmission extends Model
{
    /** @use HasFactory<SkillSubmissionFactory> */
    use HasFactory;

    public const STATUS_QUEUED = 'queued';

    public const STATUS_GRADED = 'graded';

    public const STATUS_FAILED = 'failed';

    public const FORMAT_TEXT = 'text';

    public const FORMAT_IMAGE = 'image';

    public const FORMAT_FILE = 'file';

    public const FORMAT_LINK = 'link';

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'ai_passed' => 'boolean',
            'ai_strengths' => 'array',
            'ai_fixes' => 'array',
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
     * @return BelongsTo<SkillLesson, $this>
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(SkillLesson::class, 'skill_lesson_id');
    }
}
