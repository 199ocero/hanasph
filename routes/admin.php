<?php

use App\Http\Controllers\Admin\AdminSkillCourseController;
use App\Http\Controllers\Admin\AdminTaskController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('tasks/{task}', [AdminTaskController::class, 'show'])->name('tasks.show');
    Route::get('skills/{course}', [AdminSkillCourseController::class, 'show'])->name('skills.show');
});
