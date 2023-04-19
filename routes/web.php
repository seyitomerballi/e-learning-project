<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/courses')->group(function () {
        Route::get('/', [App\Http\Controllers\CoursesController::class, 'index'])->name('courses.index');

        Route::get('/create', [App\Http\Controllers\CoursesController::class, 'create'])->name('courses.create');
        Route::post('/save', [App\Http\Controllers\CoursesController::class, 'save'])->name('courses.save');

        Route::get('/edit/{id}', [App\Http\Controllers\CoursesController::class, 'edit'])->name('courses.edit');
        Route::post('/update/{id}', [App\Http\Controllers\CoursesController::class, 'update'])->name('courses.update');
        Route::get('/delete/{id}', [App\Http\Controllers\CoursesController::class, 'delete'])->name('courses.delete');
    });

});
