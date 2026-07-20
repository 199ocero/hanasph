<?php

namespace App\Models;

use Database\Factories\OptionFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $beat_id
 * @property int $order
 * @property string $body
 * @property bool $is_correct
 * @property string|null $diagnostic
 * @property int|null $lesson_id
 * @property-read Beat $beat
 * @property-read Lesson|null $lesson
 */
#[Fillable([
    'beat_id',
    'order',
    'body',
    'is_correct',
    'diagnostic',
    'lesson_id',
])]
class Option extends Model
{
    /** @use HasFactory<OptionFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_correct' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<Beat, $this>
     */
    public function beat(): BelongsTo
    {
        return $this->belongsTo(Beat::class);
    }

    /**
     * @return BelongsTo<Lesson, $this>
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
