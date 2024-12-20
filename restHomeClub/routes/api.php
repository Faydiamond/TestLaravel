<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RolController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ApartamentController;
use App\Http\Controllers\API\ReserveController;
use App\Http\Controllers\API\IncidentController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\PayController;

//http://127.0.0.1:8000/api/v1/rols
Route::prefix('v1/roles')->group(function () {
    Route::get('', [RolController::class, 'getRols']);
    Route::post('', [RolController::class, 'saveRol']);
    Route::get('/{id}', [RolController::class, 'getRolById']);
    Route::put('/{id}', [RolController::class, 'updateRol']);
    Route::delete('/{id}', [RolController::class, 'deleteRol']);
});

Route::prefix('v1/ciudades')->group(function () {
    Route::get('', [CityController::class, 'getCitys']);
    Route::post('', [CityController::class, 'saveCity']);
    Route::get('/{id}', [CityController::class, 'getCityById']);
    Route::put('/{id}', [CityController::class, 'updateCity']);
    Route::delete('/{id}', [CityController::class, 'deleteCity']);
});

Route::prefix('v1/usuarios')->group(function () {
    Route::get('', [UserController::class, 'getUsers']);
    Route::post('', [UserController::class, 'saveUser']);
    Route::get('/{id}', [UserController::class, 'getUseryById']);
    Route::put('/{id}', [UserController::class, 'updateUser']);
    Route::delete('/{id}', [UserController::class, 'deleteUser']);
});

Route::prefix('v1/apartamentos')->group(function () {
    Route::get('', [ApartamentController::class, 'getAptaments']);
    Route::post('', [ApartamentController::class, 'saveApartament']);
    Route::get('/{id}', [ApartamentController::class, 'getAptoyById']);
    Route::put('/{id}', [ApartamentController::class, 'updateApto']);
    Route::delete('/{id}', [ApartamentController::class, 'deleteApto']);
});

Route::prefix('v1/reservas')->group(function () {
    Route::get('', [ReserveController::class, 'getReser']);
    Route::post('', [ReserveController::class, 'saveReserve']);
    Route::get('/{id}', [ReserveController::class, 'getReserveById']);
    Route::put('/{id}', [ReserveController::class, 'updateReserve']);
    Route::delete('/{id}', [ReserveController::class, 'deleteReserve']);
});

//
Route::prefix('v1/incidentes')->group(function () {
    Route::get('', [IncidentController::class, 'getIncidents']);
    Route::post('', [IncidentController::class, 'saveIncident']);
    Route::get('/{id}', [IncidentController::class, 'getIncidentById']);
    Route::put('/{id}', [IncidentController::class, 'updateIncident']);
    Route::delete('/{id}', [IncidentController::class, 'deleteIncident']);
});

//
Route::prefix('v1/tareas')->group(function () {
    Route::get('', [TaskController::class, 'getTasks']);
    Route::post('', [TaskController::class, 'saveTask']);
    Route::get('/{id}', [TaskController::class, 'getTasktById']);
    Route::put('/{id}', [TaskController::class, 'updateTask']);
    Route::delete('/{id}', [TaskController::class, 'deleteReserve']);
});

Route::prefix('v1/pagos')->group(function () {
    Route::get('', [PayController::class, 'getPays']);
    Route::post('', [PayController::class, 'savePay']);
    //Route::get('/{id}', [TaskController::class, 'getTasktById']);
    //Route::put('/{id}', [TaskController::class, 'updateTask']);
    //Route::delete('/{id}', [TaskController::class, 'deleteReserve']);
});
