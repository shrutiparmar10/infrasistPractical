<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::apiResources(['employee'=>EmployeeController::class]);
Route::get('loadCountry',[EmployeeController::class,'loadCountry']);
Route::get('loadState',[EmployeeController::class,'loadState']);
Route::get('loadCity',[EmployeeController::class,'loadCity']);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('{path}', [HomeController::class, 'index'])->where('path','([A-z\d\-\/_.]+)?');