<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::apiResource('contacts', ContactController::class);
Route::apiResource('addresses', AddressController::class);
