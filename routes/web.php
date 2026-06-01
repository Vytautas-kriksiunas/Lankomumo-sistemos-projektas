<?php

use App\Http\Controllers\LangController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\SubjectController;
use App\Models\Lecturer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;




Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [LecturerController::class, 'index'])->name('lecturer.index');
    Route::get('/orderBy/{field}/{order}', [LecturerController::class, 'orderBy'])->name('lecturer.orderBy');
    Route::post('/filterBy', [LecturerController::class, 'filterBy'])->name('lecturer.filterBy');
    // ------- LANKOMUMAS -------

// Studento lankomumo žymėjimas ir savo istorija
    Route::post('/attendance/mark', [AttendanceController::class, 'markAttendance'])->name('attendance.mark');
    Route::get('/my-attendance', [AttendanceController::class, 'myAttendance'])->name('attendance.my');

// Dalyko lankomumo puslapis (visiems prisijungusiems)
    Route::get('/subjects/{subject}/attendance', [AttendanceController::class, 'index'])->name('attendance.index');

// Paskaitos kūrimas ir trynimas (tik admin/superAdmin)
    Route::post('/subjects/{subject}/attendance/lecture', [AttendanceController::class, 'storeLecture'])->name('attendance.storeLecture');
    Route::delete('/subjects/{subject}/attendance/lecture/{lecture}', [AttendanceController::class, 'destroyLecture'])->name('attendance.destroyLecture');




    Route::get('/changeLanguage/{lang}', [LangController::class, 'changeLanguage'])->name('lang.changeLanguage');


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('subjects', SubjectController::class)->only(['index']);

    Route::group(['middleware' => [\App\Http\Middleware\Testas::class]], function () {
        Route::resource('subjects', SubjectController::class)->except(['index']);
        Route::get('/lecturer/create', [LecturerController::class, 'create'])->name('lecturer.create');
        Route::post('/lecturer', [LecturerController::class, 'store'])->name('lecturer.store');
        Route::get('/lecturer/{lecturer}', [LecturerController::class, 'edit'])->name('lecturer.edit');
        Route::put('lecturer/{lecturer}', [LecturerController::class, 'update'])->name('lecturer.update');
        Route::get('lecturer/{lecturer}/destroy', [LecturerController::class, 'destroy'])->name('lecturer.destroy');
        Route::get('lecturer/{lecturer}/deletePhoto', [LecturerController::class, 'deletePhoto'])->name('lecturer.deletePhoto');
    });

});




Auth::routes();


