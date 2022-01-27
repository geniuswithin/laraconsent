<?php

use Illuminate\Support\Facades\Route;
use Ekoukltd\LaraConsent\Http\Controllers\ConsentOptionController;
use Ekoukltd\LaraConsent\Http\Controllers\LaraConsentController;

$adminPrefix = config('laraconsent.routes.admin.prefix').".";

//Routes for admins to update Consent Options
Route::get('/', [ConsentOptionController::class, 'index'])->name($adminPrefix.'index');
Route::get('submitted', [LaraConsentController::class, 'index'])->name($adminPrefix.'submitted');


Route::get('create', [ConsentOptionController::class, 'create'])->name($adminPrefix.'create');
Route::post('save', [ConsentOptionController::class, 'store'])->name($adminPrefix.'store');

Route::get('{consentOption}', [ConsentOptionController::class, 'show'])->name($adminPrefix.'show');
Route::get('{consentOption}/edit', [ConsentOptionController::class, 'edit'])->name($adminPrefix.'edit');

Route::match(['put','patch'],'{consentOption}', [ConsentOptionController::class, 'update'])->name($adminPrefix.'update');
Route::post('{consentOption}/toggle', [ConsentOptionController::class, 'toggleStatus'])->name($adminPrefix.'toggle');



