<?php

use Illuminate\Support\Facades\Route;

Route::get('welcome', function () {
    return view('welcome');
})->name('welcome');

Route::prefix('hotels')
    ->namespace('App\Modules\Hotel\V1\Routes')
    ->group(base_path('app/Modules/Hotel/V1/Routes/web.php'));
