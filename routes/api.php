<?php

use App\Http\Controllers\API\LecturerAPIController;
use App\Http\Controllers\API\SubjectAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/lecturers', [LecturerAPIController::class, 'index'] );
Route::get('/lecturers/{id}', [LecturerAPIController::class, 'show'] );
Route::post('/lecturers', [LecturerAPIController::class, 'store'] );
Route::put('/lecturers/{id}', [LecturerAPIController::class, 'update'] );
Route::delete('/lecturers/{id}', [LecturerAPIController::class, 'destroy'] );


Route::resource('subjects', SubjectAPIController::class)->only('index', 'show', 'store', 'update', 'destroy');
