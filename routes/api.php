<?php

use Gtmassey\NovaOrderField\Http\OrderFieldRequestHandler;
use Illuminate\Support\Facades\Route;

Route::post('{resource}', OrderFieldRequestHandler::class);
