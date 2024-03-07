<?php

use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/master',function () {
    return view('master');
});

// Route::get('/event',function () {
//     return view('Event');
// });

Route::get('/Org',function () {
    return view('Organisateur.dashbordOrg');
});

Route::get('/event', [AdminEventController::class, 'index2']);



Route::resource('Event',EventController::class);

Route::resource('AdminEvent',AdminEventController::class);
// Nouvelles routes pour accepter et refuser un événement
Route::get('/AdminEvent/{id}/accept', [AdminEventController::class, 'accept'])->name('AdminEvent.accept');
Route::get('/AdminEvent/{id}/reject', [AdminEventController::class, 'reject'])->name('AdminEvent.reject');


// Display the dashboard with the user list
Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
// Handle user deletion
Route::delete('/dashboard/{user}', [UserController::class, 'destroy'])->name('users.destroy');



Route::resource('categories',CategorieController::class);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
