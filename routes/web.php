<?php

use App\Http\Controllers\NameController;
use Illuminate\Support\Facades\Route;

Route::resource('name', NameController::class);
