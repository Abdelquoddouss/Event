<?php

use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
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







Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/welcome', function () {
    return view('welcome'); 
});


    Route::get('/event', [AdminEventController::class, 'index2']);
    Route::get('/events', [UserController::class, 'search']);
    Route::get('/event/search', [EventController::class, 'searchTitre'])->name('event.search');
    Route::get('/welcome', [UserController::class, 'index2'])->name('welcome.index2');
    Route::get('/reservation/{event}', [ReservationController::class,'show'])->name('reservation.show');
    
    Route::post('/reservation/{id}', [ReservationController::class,'reserver'])->name('reservation');


Route::group(['middleware' => ['isAdmin']], function () {
    Route::get('/master',function () {
        return view('master');
    });
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::delete('/dashboard/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::resource('categories',CategorieController::class);
    Route::resource('AdminEvent',AdminEventController::class);
    Route::get('/AdminEvent/{id}/accept', [AdminEventController::class, 'accept'])->name('AdminEvent.accept');
    Route::get('/AdminEvent/{id}/reject', [AdminEventController::class, 'reject'])->name('AdminEvent.reject');

});



Route::group(['middleware' => ['isOrganisateur']], function () {
    Route::get('/Org',function () {
        return view('Organisateur.dashbordOrg');
    });
    Route::resource('Event',EventController::class);
    Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::get('/reservations', [ReservationController::class, 'index']);

});




require __DIR__.'/auth.php';
