<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\SubscriptionRequest;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $subscriptions = Subscription::all();

        return response(['ok' => $subscriptions], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'subtopic_id' => 'required'
        ]);

        if (!$validator->fails()) {
            $subscriptionExists = Subscription::where('user_id', $request['user_id'])
                ->where('subtopic_id', $request['subtopic_id'])->limit(1)
                ->get()
                ->toArray();
            if (count($subscriptionExists) > 0) {
                return response()
                    ->json(['error' => "You have alredy been subscribed to this topic!"], 200);
            } else {
                $subscription = Subscription::create($request->all());
                if ($subscription) {
                    return response()
                        ->json(['ok' => "Subscribed successfully!"], 201);
                } else {
                    return response()
                        ->json(['error' => "Something went wrong! Unable to add subscription."], 201);
                }
            }
        } else {
            return response()->json(['error' => $validator->errors()], 422);
        }
    }

    public function show($id)
    {
        $subscription = Subscription::findOrFail($id);
        return response()->json(['ok' => $subscription], 200);
    }

    public function update(SubscriptionRequest $request, $id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->update($request->all());

        return response(['ok' => $subscription], 200);
    }

    public function destroy($id)
    {
        $destroyed = Subscription::destroy($id);
        return $destroyed == 1 ?  response()->json(['ok' => 'Subscription deleted'], 200) :
            response()->json(['error' => 'Something went wrong! Unable to delete subscription!'], 500);
    }
}
