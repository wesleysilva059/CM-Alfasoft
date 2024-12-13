<?php

use App\Http\Controllers\ContactController;
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
    return view('welcome');
});

Route::prefix('contacts')->group(function(){
    Route::get('/',  [ContactController::class, 'index'])->name('contacts.index');
    Route::get('create', [ContactController::class, 'create'])->name('contacts.create');
    Route::get('edit/{contact}',  [ContactController::class, 'edit'])->name('contacts.edit');
    Route::post('store', [ContactController::class, 'store'])->name('contacts.store');
    Route::put('update/{contact}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('delete/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::get('show/{contact}', [ContactController::class, 'show'])->name('contacts.show');
});
