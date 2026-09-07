<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::resource('students', StudentController::class);

Route::get('/', function () {
    $students = App\Models\Student::all();

    return view('students.index', compact('students'));
});
