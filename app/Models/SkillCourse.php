<?php

namespace App\Models;

use Database\Factories\SkillCourseFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $skill_key
 * @property string $title
 * @property string|null $subtitle
 * @property string|null $icon
 * @property int $order
 * @property string $source
 * @property Carbon|null $published_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, SkillLesson> $lessons
 */
#[Fillable([
    'skill_key',
    'title',
    'subtitle',
    'icon',
    'order',
    'source',
    'published_at',
])]
class SkillCourse extends Model
{
    /** @use HasFactory<SkillCourseFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    /**
     * @return HasMany<SkillLesson, $this>
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(SkillLesson::class)->orderBy('order');
    }

    /**
     * @param  Builder<SkillCourse>  $query
     */
    public function scopePublished(Builder $query): void
    {
        $query->whereNotNull('published_at');
    }

    public function isPublished(): bool
    {
        return $this->published_at !== null;
    }

    public function getRouteKeyName(): string
    {
        return 'skill_key';
    }
}
