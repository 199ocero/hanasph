<?php

namespace App\Models;

use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $slug
 * @property int $order
 * @property string $title
 * @property string $client_persona
 * @property string $scenario_intro
 * @property int $xp_reward
 * @property bool $is_gentle_opener
 * @property bool $is_intro
 * @property string|null $onboarding_entry_key
 * @property string $category
 * @property bool $ai_grading_enabled
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Beat> $beats
 */
#[Fillable([
    'slug',
    'order',
    'title',
    'client_persona',
    'scenario_intro',
    'xp_reward',
    'is_gentle_opener',
    'is_intro',
    'onboarding_entry_key',
    'category',
    'ai_grading_enabled',
])]
class Task extends Model
{
    /** @use HasFactory<TaskFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_gentle_opener' => 'boolean',
            'is_intro' => 'boolean',
            'ai_grading_enabled' => 'boolean',
        ];
    }

    /**
     * @return HasMany<Beat, $this>
     */
    public function beats(): HasMany
    {
        return $this->hasMany(Beat::class)->orderBy('order');
    }

    /**
     * @return HasMany<UserTaskProgress, $this>
     */
    public function progress(): HasMany
    {
        return $this->hasMany(UserTaskProgress::class);
    }

    /**
     * The next task in the ordered sequence, if any.
     */
    public function nextTask(): ?Task
    {
        return static::query()
            ->where('order', '>', $this->order)
            ->orderBy('order')
            ->first();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
