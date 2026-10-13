<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\VisitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/visits', VisitController::class)->name('visits.store');
Route::post('/contact', ContactController::class)->name('contact.admin');
Route::get('/projects', ProjectsController::class)->name('projects.index');