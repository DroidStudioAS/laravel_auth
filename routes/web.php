<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\WeatherController;
use App\Http\Middleware\AdminMiddleware;
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
//user routes
Route::middleware('auth')->group(function (){
    Route::get("/",[HomeController::class,"toLogin"]);
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get("/weather",[WeatherController::class, 'loadTodaysWeathers']);
    Route::get("/weather/{date?}",[WeatherController::class,'getWeathersForDate'])->name("getWeatherForDate");
    Route::get("/weather-for/{city}",[WeatherController::class,"getWeatherForecastForCity"]);
    Route::get("/weather-for-country/{country}",[WeatherController::class,"getCountryForecast"]);
});
//admin routes
Route::middleware(['auth', AdminMiddleware::class])
    ->prefix('admin')
    ->group(function (){
        Route::get("/",[WeatherController::class, 'getAllWeathersAdmin']);
        Route::post('/edit-entry/{weather}',[WeatherController::class,'editWeatherEntry'])->name("edit-weather");
        Route::post('/delete-entry/{weather}',[WeatherController::class,'deleteWeatherEntry']);
        Route::post('/post-forecast', [WeatherController::class,'postForecastEntry']);
        Route::post("/delete-forecast/{forecast}",[WeatherController::class,"deleteForecastEntry"]);
});
Route::get("/testing", [WeatherController::class,'test']);


Auth::routes();



