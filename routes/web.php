<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProjectController::class, 'index']);

Route::resource('projects', ProjectController::class);

// Route::resource('students', StudentController::class);

Route::get('students/add/{project_id}', [StudentController::class, 'add'])->name('students.add');
Route::post('students', [StudentController::class, 'store'])->name('students.store');
Route::delete('students/{student_id}', [StudentController::class, 'destroy'])->name('students.destroy');