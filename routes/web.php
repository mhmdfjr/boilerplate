<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Accounts\ProfileController;
use App\Http\Controllers\Resources\PermissionController;
use App\Http\Controllers\Resources\JournalController;
use App\Http\Controllers\Resources\AuthorController;
use App\Http\Controllers\MailtrapController;

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
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::prefix("account")->name("account.")->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::get('/change-password', [ProfileController::class, 'password'])->name('profile.password');
        Route::patch('/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

});

Route::middleware('auth')->group(function () {

    Route::prefix("journals")->name("journals.")->group(function () {
        Route::get('/', [JournalController::class, 'index'])->name('index'); // List all journals
        Route::get('/create', [JournalController::class, 'create'])->name('create'); // Show create form
        Route::post('/', [JournalController::class, 'store'])->name('store'); // Store new journal
        Route::get('/{journal}', [JournalController::class, 'show'])->name('show'); // Show single journal
        Route::get('/{journal}/edit', [JournalController::class, 'edit'])->name('edit'); // Show edit form
        Route::patch('/{journal}', [JournalController::class, 'update'])->name('update'); // Update journal
        Route::delete('/{journal}', [JournalController::class, 'destroy'])->name('destroy'); // Delete journal
    });

});

Route::middleware('auth')->group(function () {

    Route::prefix("authors")->name("authors.")->group(function () {
        Route::get('/', [AuthorController::class, 'index'])->name('index'); // List all journals
        Route::get('/create', [AuthorController::class, 'create'])->name('create'); // Show create form
        Route::post('/', [AuthorController::class, 'store'])->name('store'); // Store new journal
        Route::get('/{author}', [AuthorController::class, 'show'])->name('show'); // Show single author
        Route::get('/{author}/edit', [AuthorController::class, 'edit'])->name('edit'); // Show edit form
        Route::patch('/{author}', [AuthorController::class, 'update'])->name('update'); // Update author
        Route::delete('/{author}', [AuthorController::class, 'destroy'])->name('destroy'); // Delete journal
    });

});

Route::get('/mailtrap-emails', [MailtrapController::class, 'fetchEmails']);

require __DIR__.'/auth.php';
require __DIR__.'/resources.php';
require __DIR__.'/master.php';