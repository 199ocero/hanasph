<?php

namespace App\Models;

use Database\Factories\BeatFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $task_id
 * @property int $order
 * @property string $client_message
 * @property string|null $scaffold_hint
 * @property-read Task $task
 * @property-read Collection<int, Option> $options
 */
#[Fillable([
    'task_id',
    'order',
    'client_message',
    'scaffold_hint',
])]
class Beat extends Model
{
    /** @use HasFactory<BeatFactory> */
    use HasFactory;

    /**
     * @return BelongsTo<Task, $this>
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * @return HasMany<Option, $this>
     */
    public function options(): HasMany
    {
        return $this->hasMany(Option::class)->orderBy('order');
    }
}
