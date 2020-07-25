<?php

namespace App\Http\Controllers;

use App\Models\Subtopic;
use App\Http\Requests\SubtopicRequest;


class SubtopicController extends Controller
{
    public function index()
    {
        $subtopics = Subtopic::latest()->get();

        return response(['data' => $subtopics ], 200);
    }

    public function store(SubtopicRequest $request)
    {
        $subtopic = Subtopic::create($request->all());

        return response(['data' => $subtopic ], 201);

    }

    public function show($id)
    {
        $subtopic = Subtopic::findOrFail($id);

        return response(['data', $subtopic ], 200);
    }

    public function update(SubtopicRequest $request, $id)
    {
        $subtopic = Subtopic::findOrFail($id);
        $subtopic->update($request->all());

        return response(['data' => $subtopic ], 200);
    }

    public function destroy($id)
    {
        Subtopic::destroy($id);

        return response(['data' => null ], 204);
    }
}
