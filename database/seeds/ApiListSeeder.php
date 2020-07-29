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
            [
                "base" => "https://api.openweathermap.org",
                "uri" => "/data/2.5/weather",
                "topic" => 1
            ],
            [
                "base" =>   "https://api.weatherbit.io",
                "uri" => "/v2.0/current",
                "topic" => 1
            ],
            [
                "base" => "http://dataservice.accuweather.com",
                "uri" => "/locations/v1/cities/geoposition/search",
                "topic" => 1
            ]
        );
        foreach ($apiList as $key => $value) {
            ApiList::create([
                "base" => $value['base'],
                "uri" => $value["uri"],
                "topic_id" => $value["topic"]
            ]);
        }
    }
}
