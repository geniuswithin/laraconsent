<?php

use Illuminate\Support\Facades\Route;
use Ekoukltd\LaraConsent\Http\Controllers\LaraConsentController;

//Routes for users to view and save their consent
Route::get('/request', [LaraConsentController::class, 'request'])->name(config('laraconsent.routes.user.prefix').'.request');
Route::post('/request', [LaraConsentController::class, 'store'])->name(config('laraconsent.routes.user.prefix').'.store');
Route::get('/my-consents', [LaraConsentController::class, 'show'])->name(config('laraconsent.routes.user.prefix').'.show');
Route::post('{consentOptionUser}/toggle', [LaraConsentController::class, 'toggle'])->name(config('laraconsent.routes.user.prefix').'.toggle');
Route::get('/print', [LaraConsentController::class, 'print'])->name(config('laraconsent.routes.user.prefix').'.print');