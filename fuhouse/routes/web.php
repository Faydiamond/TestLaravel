<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ApartamentsController;
use App\Http\Controllers\IncidentsController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\TasksController;

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

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('users/create', [UsersController::class, 'create'])->name('create');
Route::get('users', [UsersController::class, 'index'])->name('users');
Route::post('store', [UsersController::class, 'store'])->name('store');
Route::get('show/{id}', [UsersController::class, 'show'])->name('show');
Route::get('edit/{id}', [UsersController::class, 'edit'])->name('edit');
Route::put('update/{id}', [UsersController::class, 'update'])->name('update');
Route::delete('destroy/{id}', [UsersController::class, 'destroy'])->name('destroy');

//apartaments
Route::get('apartaments', [ApartamentsController::class, 'index'])->name('apartaments');
Route::get('apartaments/create', [ApartamentsController::class, 'create'])->name('createApto');
Route::post('storeapto', [ApartamentsController::class, 'store'])->name('storeApto');
Route::get('editApto/{id}', [ApartamentsController::class, 'edit'])->name('editApto');
Route::put('updateApto/{id}', [ApartamentsController::class, 'update'])->name('updateApto');
Route::delete('destroyApto/{id}', [ApartamentsController::class, 'destroy'])->name('destroyApto');

//reservations
Route::get('reservations', [ReservationsController::class, 'index'])->name('reservations');
Route::get('reservar/{iduser}/{idapto}', [ReservationsController::class, 'create'])->name('reservar');
Route::post('storeReservation', [ReservationsController::class, 'store'])->name('storeReservation');
Route::get('myserserve/{id}', [ReservationsController::class, 'show'])->name('myserserve');
Route::get('editreserve/{id}', [ReservationsController::class, 'edit'])->name('editreserve');
Route::put('updatereserve/{id}', [ReservationsController::class, 'update'])->name('updatereserve');
Route::delete('destroyreserve/{id}', [ReservationsController::class, 'destroy'])->name('destroyreserve');


//incidents
Route::get('incidents', [IncidentsController::class, 'index'])->name('incidents');
Route::get('incidents/create', [IncidentsController::class, 'create'])->name('incidentscreate');
Route::post('storeincident', [IncidentsController::class, 'store'])->name('storeincident');
Route::get('editincident/{id}', [IncidentsController::class, 'edit'])->name('editincident');
Route::delete('destroyincident/{id}', [IncidentsController::class, 'destroy'])->name('destroyincident');

//tasks
Route::get('tasks', [TasksController::class, 'index'])->name('tasks');
Route::get('taskscreate', [TasksController::class, 'create'])->name('taskscreate');
Route::post('storetask', [TasksController::class, 'store'])->name('storetask');
Route::get('editask/{id}', [TasksController::class, 'edit'])->name('editask');
Route::put('updatetask/{id}', [TasksController::class, 'update'])->name('updatetask');
