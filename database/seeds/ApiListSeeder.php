<?php

use App\Models\ApiList;
use Illuminate\Database\Seeder;


class ApiListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apiList = array(
            "https://api.openweathermap.org/data/2.5/weather",
            "https://api.weatherbit.io/v2.0/current",
            "http://dataservice.accuweather.com/locations/v1/cities/geoposition/search",
        );
        foreach ($apiList as $key => $value) {
            ApiList::create(["url"=> $value]);
        }
    }
}
