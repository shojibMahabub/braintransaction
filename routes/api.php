<?php

use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/logout', 'App\Http\Controllers\AuthController@logout');

Route::post('/transaction', 'App\Http\Controllers\TransactionController@store');
Route::get('/transactions', 'App\Http\Controllers\TransactionController@index');
Route::get('/transaction/{id}', 'App\Http\Controllers\TransactionController@show');
Route::put('/transaction', 'App\Http\Controllers\TransactionController@update');
Route::delete('/transaction/{id}', 'App\Http\Controllers\TransactionController@destroy');
Route::get('/total', 'App\Http\Controllers\TransactionController@total');
