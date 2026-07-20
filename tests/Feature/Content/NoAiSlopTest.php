<?php

use Illuminate\Support\Facades\File;

it('keeps AI-slop em dashes out of scenario content and UI copy', function () {
    $files = collect(File::allFiles(database_path('seeders/content')))
        ->merge(File::allFiles(resource_path('js')))
        ->filter(fn ($file) => in_array($file->getExtension(), ['php', 'vue', 'ts'], true));

    $offenders = $files
        ->filter(fn ($file) => str_contains(File::get($file->getPathname()), '—'))
        ->map(fn ($file) => $file->getRelativePathname())
        ->values()
        ->all();

    expect($offenders)->toBe([]);
});
