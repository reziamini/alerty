<?php

use \Illuminate\Support\Facades\Route;

Route::get('/', [\Alerty\Http\QueryController::class, 'list']);

Route::get('/{queryEntry}', [\Alerty\Http\QueryController::class, 'show'])
    ->name('alerty.single');
