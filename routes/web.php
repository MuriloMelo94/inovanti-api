<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return [
        'Inovanti-API' => 'v1.0.0',
        'Laravel' => app()->version()
    ];
});
