<?php

use \Illuminate\Support\Facades\Route;

Route::get('/alerty', [\Alerty\Http\QueryController::class, 'list']);

Route::get('/alerty/{queryEntry}', [\Alerty\Http\QueryController::class, 'show'])
    ->name('alerty.single');
