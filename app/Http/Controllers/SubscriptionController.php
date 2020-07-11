<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Subscription;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::latest()->get();

        return response(['data' => $subscriptions ], 200);
    }

    public function store(SubscriptionRequest $request)
    {
        $subscription = Subscription::create($request->all());

        return response(['data' => $subscription ], 201);

    }

    public function show($id)
    {
        $subscription = Subscription::findOrFail($id);

        return response(['data', $subscription ], 200);
    }

    public function update(SubscriptionRequest $request, $id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->update($request->all());

        return response(['data' => $subscription ], 200);
    }

    public function destroy($id)
    {
        Subscription::destroy($id);

        return response(['data' => null ], 204);
    }
}
