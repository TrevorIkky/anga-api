<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\UserRelationsMapping;
use Illuminate\Support\Facades\Validator;

class UserRelationMappingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function createRelation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'to' => 'required',
            'start' => 'required'
        ]);
        if (!$validator->fails()) {
            if (!$this->isRelated($this->allRelationIds($request['to']), $request['start'])) {
                $relation = UserRelationsMapping::create([
                    'relation_start' => $request['start'],
                    'relation_to' => $request['to']
                ]);
                if ($relation) {
                    return response()
                        ->json(['ok' => 'Relation created successfully'], 201);
                } else {
                    return response()
                        ->json(['error' => 'Something went wrong. Unable to create relation'], 500);
                }
            } else {
                Log::info(User::where('user_id', $request['to'])->get());
                return response()
                    ->json([
                        'error' => 'Request sent or already formed relation with ' . User::where('user_id', $request['to'])->get()[0]->username
                    ]);
            }
        } else {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
    }

    public function updateRelation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'to' => 'required',
            'start' => 'required',
            'response' => 'required'
        ]);
        if (!$validator->fails()) {
            $relationQuery = UserRelationsMapping::where('relation_start', $request['start'])
                ->where('relation_to', $request['to']);
            if ($request['response'] != false) {
                $affectedRows =  $relationQuery->update(['accepted' => $request['response']]);
                if ($affectedRows > 0) {
                    return response()
                        ->json(['ok' => 'Accepted relation successfully']);
                }
            } else {
                $deletedRelation = $relationQuery->delete();
                if ($deletedRelation) {
                    return response()
                        ->json(['ok' => 'Request deleted successfully'], 200);
                } else {
                    return response()
                        ->json(['error' => 'Something went wrong! Unable to delete relation .'], 200);
                }
            }
        } else {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
    }


    public function checkIfRelated(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'myid' => 'required',
            'otherid' => 'required'
        ]);
        if (!$validator->fails()) {
            $acceptedRelations = UserRelationsMapping::where('relation_to', $request['otherid'])
                ->where('accepted', true)
                ->get()->pluck('relation_start')->toArray();
            return response()
                ->json(['ok', $this->isRelated(
                    $acceptedRelations,
                    $request['myid']
                )], 200);
        } else {
        }
        return response()
            ->json(['error' => $validator->errors()], 422);
    }



    public function isRelated($relations, $userid)
    {
        Log::info($relations);
        return count($relations) > 0  ? collect($relations)->contains($userid) : false;
    }

    public function allRelationIds($userid)
    {
        return UserRelationsMapping::where('relation_to', $userid)
            ->get()->pluck('relation_start')->toArray();
    }
}
