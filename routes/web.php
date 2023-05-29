<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Models\Project;
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

    $projects = Project::all();

    return view('welcome', compact('projects'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function() {

    // projects
    Route::resource('projects', ProjectController::class)->parameters(['projects' => 'project:slug']);
    
    Route::get('projects.filter', [ProjectController::class, 'filter'])->name('filter');


    // types
    Route::resource('types', TypeController::class)->parameters(['types' => 'type:slug']);

    // technologies
    Route::resource('technologies', TechnologyController::class)->parameters(['technologies' => 'technology:slug']);

    // dashboard
    Route::get('/', [DashboardController::class, 'home'])->name('dashboard.home');

});

require __DIR__.'/auth.php';
