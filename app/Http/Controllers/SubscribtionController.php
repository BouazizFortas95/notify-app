<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class SubscribtionController extends Controller
{

    public function show(Plan $plan, Request $request)
    {
        $intent = auth()->user()->createSetupIntent();

        return view('subscription', compact(['plan', 'intent']));
    }

    public function create(Request $request)  {
        $plan = Plan::find($request->plan);

        $subscribtion = $request->user()->newSubscription($request->plan, $plan->stripe_plane)->quantity(null)->create($request->token);
        // dd($subscribtion);
        return view("subscription_success");
    }
}
