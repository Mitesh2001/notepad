<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotesController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('save_data',[NotesController::class , 'saveData'])->name('notes.saveData');
Route::get('update_data',[NotesController::class , 'updateData'])->name('notes.updateData');
Route::get('get_data',[NotesController::class , 'getData'])->name('notes.getData');
Route::get('notes/{id?}',[NotesController::class , 'index'])->name('notes.index');

