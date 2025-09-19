<?php

use App\Http\Controllers\ServiceProviderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('providers' , ServiceProviderController::class);
