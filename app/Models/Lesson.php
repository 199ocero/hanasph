<?php

namespace App\Models;

use Database\Factories\LessonFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string $body
 */
#[Fillable([
    'slug',
    'title',
    'body',
])]
class Lesson extends Model
{
    /** @use HasFactory<LessonFactory> */
    use HasFactory;
}
