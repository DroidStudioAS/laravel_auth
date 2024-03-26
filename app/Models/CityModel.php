<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    protected $table="cities";

    protected $fillable = ["country",'city_name'];

    public function forecast(){
        //one to many relationship: One city has many forecasts;
        return $this->hasMany(ForecastModel::class, "city_id","id");
    }
    public function todaysForecast(){
        return $this->forecast()->whereDate("date", Carbon::now()->format("Y-m-d"));
    }
    public function weather(){
        return $this->hasOne(WeatherModel::class,"city_id","id");
    }



}
