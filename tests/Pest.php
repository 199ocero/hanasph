<?php

use App\Models\Beat;
use App\Models\Option;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind different classes or traits.
|
*/

pest()->extend(TestCase::class)
    ->use(RefreshDatabase::class)
    ->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

/**
 * Build a task with the given number of beats, each with 4 options where
 * option order 1 is the correct one. Handy for engine tests that don't need
 * the authored content.
 *
 * @param  array<string, mixed>  $attributes
 */
function makeTask(int $order = 1, int $beats = 2, array $attributes = []): Task
{
    $task = Task::factory()->create(['order' => $order, ...$attributes]);

    for ($b = 1; $b <= $beats; $b++) {
        $beat = Beat::factory()->create(['task_id' => $task->id, 'order' => $b]);

        for ($o = 1; $o <= 4; $o++) {
            Option::factory()->create([
                'beat_id' => $beat->id,
                'order' => $o,
                'is_correct' => $o === 1,
                'diagnostic' => $o === 1 ? null : "Wrong for reason {$o}.",
            ]);
        }
    }

    return $task->load('beats.options');
}

/**
 * The beat of a task at the given order.
 */
function beat($task, int $order)
{
    return $task->beats->firstWhere('order', $order);
}

/**
 * The option of a beat at the given order.
 */
function optionOf($beat, int $order)
{
    return $beat->options->firstWhere('order', $order);
}
