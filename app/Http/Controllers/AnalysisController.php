<?php

namespace App\Http\Controllers;

use App\Models\Analysis;
use App\Http\Requests\AnalysisRequest;
use App\Models\ApiList;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AnalysisController extends Controller
{
    public function __construct()
    {
    }

    public function getWeatherData(Request $request)
    {
        $validator = $this->latlngValidator($request);
        if (!$validator->fails()) {
            $weatherApis  = ApiList::where('topic_id', 1)->get();
            foreach ($weatherApis as $key => $value) {
                # Get api parameters and map to appropriate output.
            } 
           /** CALL OPEN weather API
            *  $response = $this->weatherApiData(1,  [
            *    "lat" => $request['lat'],
            *    "lon" => $request['lng'],
            *   "appid" => env('OPEN_WEATHER_KEY', null)
            *],);
            */


          /**
           * call ACCUWEATHER API
           *   $response = $this->weatherApiData(3, [
           *  'q' => "{$request['lat']},{$request['lng']}",
           * 'apikey' => env('ACCU_WEATHER_KEY', null)
            *]);
           */

          $response = $this->weatherApiData(2, [
              'lat' => $request['lat'], 
               'lon' =>$request['lng'],
             'key' => env('WEATHERBIT_IO_KEY', null)
             ]);


            return response()
                ->json(['ok' => $response], 200);
        } else {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
    }



    public function weatherApiData($api, $query)
    {
        $openWeatherUrl = ApiList::where('api_id', $api)->get();
        if ($openWeatherUrl && count($openWeatherUrl) > 0) {
            $client = new Client(['base_uri' => $openWeatherUrl[0]->base]);
            $response = $client->request(
                "GET",
                $openWeatherUrl[0]->uri,
                ["query" => $query]
            );
            return json_decode($response->getBody()->getContents());
        } else {
            return 'Either weather URL or API key is non-existent';
        }
    }



    public function latlngValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'lat' => 'required',
            'lng' => 'required'
        ]);
    }

    public function index()
    {
        $analyses = Analysis::latest()->get();

        return response(['data' => $analyses], 200);
    }

    public function store(AnalysisRequest $request)
    {
        $analysis = Analysis::create($request->all());

        return response(['data' => $analysis], 201);
    }

    public function show($id)
    {
        $analysis = Analysis::findOrFail($id);

        return response(['data', $analysis], 200);
    }

    public function update(AnalysisRequest $request, $id)
    {
        $analysis = Analysis::findOrFail($id);
        $analysis->update($request->all());

        return response(['data' => $analysis], 200);
    }

    public function destroy($id)
    {
        Analysis::destroy($id);

        return response(['data' => null], 204);
    }
}
