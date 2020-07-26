<?php

namespace App\Http\Controllers;

use App\Models\Analysis;
use App\Http\Requests\AnalysisRequest;


class AnalysisController extends Controller
{
    public function index()
    {
        $analyses = Analysis::latest()->get();

        return response(['data' => $analyses ], 200);
    }

    public function store(AnalysisRequest $request)
    {
        $analysis = Analysis::create($request->all());

        return response(['data' => $analysis ], 201);

    }

    public function show($id)
    {
        $analysis = Analysis::findOrFail($id);

        return response(['data', $analysis ], 200);
    }

    public function update(AnalysisRequest $request, $id)
    {
        $analysis = Analysis::findOrFail($id);
        $analysis->update($request->all());

        return response(['data' => $analysis ], 200);
    }

    public function destroy($id)
    {
        Analysis::destroy($id);

        return response(['data' => null ], 204);
    }
}
