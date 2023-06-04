<?php

use Illuminate\Support\Facades\Route;

//route home

Route::get('/', function () {
    return view('welcome');
});
