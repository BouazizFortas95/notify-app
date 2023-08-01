<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use App\Models\Epay_Invoice;
use App\Models\Plan;
use Illuminate\Support\Facades\Session;
use TheHocineSaad\LaravelChargilyEPay\Epay_Webhook;

class Pricing extends Component
{

    public function choosePlane()
    {

        // $user = Auth::user();
        // $configurations = [
        //     'user_id' => $user->id, // (optional) This is the user ID to be added as a foreign key, it's optional, if it's not provided its value will be NULL
        //     'mode' => 'CIB', // Payment method must be 'CIB' or 'EDAHABIA'
        //     'payment' => [
        //         'client_name' => $user->name, // Client name
        //         'client_email' => $user->email, // This is where client receives payment receipt after confirmation
        //         'amount' => 1000, // Must be = or > than 75
        //         'discount' => 0, // This is discount percentage, between 0 and 99
        //         'description' => 'payment for STANDARD PLAN', // This is the payment description
        //     ]
        // ];

        // $checkout_url = Epay_Invoice::make($configurations);
        // // dd($checkout_url);

        // if ($checkout_url) {
        //     redirect($checkout_url);
        // } else {
        //     dd("We can't redirect to your payment now!");
        // }


        // $webhookHandler = new Epay_Webhook;

        // if ($webhookHandler->invoiceIsPaied) {
        //     Session::flash('message', 'The Payment has been created successfull with Invoice information.');
        //     Session::flash('bg', 'green');
        //     // dd($webhookHandler->invoice);
        // } else {
        //     // dd("Error : ".$webhookHandler->invoice);
        //     Session::flash('message', 'The Payment has not created!!!');
        //     Session::flash('bg', 'red');
        // }
    }

    public function render()
    {
        $plans = Plan::get();
        return view('livewire.pricing', compact('plans'));
    }
}
