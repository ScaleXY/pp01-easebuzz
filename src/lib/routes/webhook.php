<?php

use Illuminate\Support\Facades\Route;
use ScaleXY\Easebuzz\InstaCollect;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::post('/service_apis/',	[InstaCollect::class,  'handleWebhook'])->name('scalexy_easebuzz_webhook');
