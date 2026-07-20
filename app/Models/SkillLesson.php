<?php

namespace App\Models;

use Database\Factories\SkillLessonFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $skill_course_id
 * @property int $order
 * @property string $title
 * @property string $brief
 * @property array<int, array{criterion: string, weight: int, what_good_looks_like: string}> $rubric
 * @property string|null $reference_notes
 * @property array<int, string> $accepted_formats
 * @property string $difficulty
 * @property int $xp_reward
 * @property Carbon|null $published_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read SkillCourse $course
 */
#[Fillable([
    'skill_course_id',
    'order',
    'title',
    'brief',
    'rubric',
    'reference_notes',
    'accepted_formats',
    'difficulty',
    'xp_reward',
    'published_at',
])]
class SkillLesson extends Model
{
    /** @use HasFactory<SkillLessonFactory> */
    use HasFactory;

    /**
     * The grading criteria are server-only; hide them so they can never be
     * accidentally serialized to the client.
     *
     * @var list<string>
     */
    protected $hidden = ['rubric', 'reference_notes'];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'rubric' => 'array',
            'accepted_formats' => 'array',
            'published_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<SkillCourse, $this>
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(SkillCourse::class, 'skill_course_id');
    }

    /**
     * @param  Builder<SkillLesson>  $query
     */
    public function scopePublished(Builder $query): void
    {
        $query->whereNotNull('published_at');
    }
}
