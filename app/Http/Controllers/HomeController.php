<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserFollowNotification;
use App\Notifications\WelcomeNotify;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Twilio\Rest\Client;

class HomeController extends Controller
{
    public function __invoke()
    {

        // $page = [
        //     'title' => 'Page One',
        //     'slug' => 'page-one',
        //     'description' => 'This is a first page from database.'
        // ];
        // $users = User::all();
        // foreach ($users as $key => $user) {
        //    $user->notify( new WelcomeNotify($page));
        // }

        // dd('DONE!!!');
        return view('welcome');
    }

    public function notify()
    {
        $auth = Auth::user();
        if ($auth) {
            $users = User::where('id', '>', 1)->get();
            foreach ($users as $key => $user) {
                $auth->notify(new UserFollowNotification($user));
            }
        }

        dd('Notified Follwing Successful!');
    }

    public function sendSMS() {

        $receiverNumber = "+213775841030";
        $message = "This is testing from notify.dev";

        try {

            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message]);

            dd('SMS Sent Successfully.'.$client);

        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }
}
