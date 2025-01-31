<?php

use App\Modules\Hotel\V1\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HotelController::class, 'index'])->name('hotels.index');
