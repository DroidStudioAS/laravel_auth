<?php

namespace App\Http\Controllers;

use App\Helpers\WeatherHelper;
use App\Models\CityModel;
use App\Models\ForecastModel;
use App\Models\WeatherModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;


class WeatherController extends Controller
{
    public function loadTodaysWeathers(){
        $date = Carbon::today()->format('Y-m-d');

        $weathers = ForecastModel::where("date", $date)->paginate(6);

        return view("welcome", compact('weathers', 'date'));
    }

    public function searchAll(Request $request)
    {
        $request->validate([
            "city_name" => "nullable|string",
            "country" => "nullable|string",
            "date" => "nullable|string"
        ]);

        $paramsSent = false;
        foreach ($request->all() as $param) {
            if ($param !== null) {
                $paramsSent = true;
                break;
            }
        }

        if($paramsSent===false){
            return redirect("/weather");
        }

        $forecastQuery = ForecastModel::query();
        // Initialize the variables from the request
        $city_name = $request->city_name;
        $date = $request->date;
        $country = $request->country;
        if($date===null){
            $date=Carbon::now()->format("Y-m-d");
        }

        $forecastQuery->where("date",$date);
        /**********/
        if($city_name!==null){
            $forecastQuery->whereHas("city", function ($query) use ($city_name){
               $query->where("city_name", "LIKE","%$city_name%");
            });
        }
        if($country!==null){
            $forecastQuery->whereHas("city", function ($query) use ($country){
                $query->where("country", "LIKE","%$country%");
            });
        }

        $weathers = $forecastQuery->get();

        return view("search_results", compact("weathers"));

    }




}
