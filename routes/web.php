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

Route::get("/",[\App\Http\Controllers\HomeController::class,"toLogin"]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get("/welcome",function (){
   return view("welcome");
});
Route::get("/weather", [\App\Http\Controllers\WeatherController::class, 'getAllWeathers']);


//admin routes
Route::get("/admin",[\App\Http\Controllers\WeatherController::class, 'getAllWeathersAdmin']);
Route::post('admin/postWeather',[\App\Http\Controllers\WeatherController::class,'postWeatherEntry'])
    ->name('post-weather');
Route::post('/admin/edit-entry/{weather}',[\App\Http\Controllers\WeatherController::class,'editWeatherEntry']);
