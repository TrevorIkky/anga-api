<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiListRequest;
use App\ApiList;

class ApiListController extends Controller
{
    public function index()
    {
        $apilists = ApiList::latest()->get();

        return response(['data' => $apilists ], 200);
    }

    public function store(ApiListRequest $request)
    {
        $apilist = ApiList::create($request->all());

        return response(['data' => $apilist ], 201);

    }

    public function show($id)
    {
        $apilist = ApiList::findOrFail($id);

        return response(['data', $apilist ], 200);
    }

    public function update(ApiListRequest $request, $id)
    {
        $apilist = ApiList::findOrFail($id);
        $apilist->update($request->all());

        return response(['data' => $apilist ], 200);
    }

    public function destroy($id)
    {
        ApiList::destroy($id);

        return response(['data' => null ], 204);
    }
}
