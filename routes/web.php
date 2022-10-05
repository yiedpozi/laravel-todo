<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'TaskController@index')->name('task.index');
Route::get('/create', 'TaskController@create')->name('task.create');
Route::post('/', 'TaskController@store')->name('task.store');
Route::get('/{task}/edit', 'TaskController@edit')->name('task.edit');
Route::put('/{task}', 'TaskController@update')->name('task.update');
Route::put('/{task}/complete', 'TaskController@complete')->name('task.complete');
Route::delete('/{task}', 'TaskController@destroy')->name('task.destroy');
