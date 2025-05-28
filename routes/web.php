<?php

use App\Http\Controllers\NameController;
use Illuminate\Support\Facades\Route;

Route::resource('name', NameController::class);
Route::get('get-names', [NameController::class, 'getNames'])->name('getnames');
