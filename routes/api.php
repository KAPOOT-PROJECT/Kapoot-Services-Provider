<?php

use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\ServiceProviderStaffController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('providers/nearest', [ServiceProviderController::class, 'nearest']);
Route::apiResource('providers', ServiceProviderController::class);
Route::post('providers/{provider}/verify', [ServiceProviderController::class, 'verify']);
Route::post('providers/{provider}/updateRating', [ServiceProviderController::class, 'updateRating']);
Route::get('availble-providers', [ServiceProviderController::class , 'available']);


Route::apiResource('providersStaff', ServiceProviderStaffController::class);
Route::post('providersStaff/{providersStaff}/setAvailability', [ServiceProviderStaffController::class, 'setAvailability']);
Route::post('providersStaff/{providersStaff}/assignBooking', [ServiceProviderStaffController::class, 'assignToBooking']);
Route::post('providersStaff/{providersStaff}/completeBooking', [ServiceProviderStaffController::class, 'completeBooking']);
Route::post('providersStaff/{providersStaff}/updateRating', [ServiceProviderStaffController::class, 'updateRating']);
