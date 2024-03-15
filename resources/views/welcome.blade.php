@extends("layouts.layout")

@section("content")

    <div class="search_container">
        <h3>Weather on: {{$date}}</h3>
        <input class="date" type="text" id="datepicker" placeholder="select another date">
        <button  class="submit-button">Search</button>
    </div>
    <div class="weather_cards_container">
        @foreach($weathers as $weather)
            <div class="weather_card">
                <p class="weather_city">{{$weather->city}}</p>
                <div class="weather_column">
                    <img class="weather_image" src="{{asset($weather->path_to_image)}}" alt="weather photo">
                    <p class="weather_description">{{$weather->description}}</p>
                </div>
                <svg class="divider">
                    <rect x="0" y="0" width="1px" height="30vh" fill="white"></rect>
                </svg>

                <div class="weather_column">
                    <div class="temperature_container">
                        <h1 class="weather_temperature">
                            {{$weather->temperature}}°
                        </h1>
                    </div>
                    <p class="weather_date">{{\Carbon\Carbon::parse($weather->created_at)->format('d F Y')}}</p>
                </div>
            </div>
        @endforeach
    </div>
    <script>
        $(document).ready(function(){
            $('#datepicker').datepicker({
                format:'yyyy-mm-dd',
                endDate:new Date(),
                autoclose:true
            });
        });
    </script>

@endsection
