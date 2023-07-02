<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserFollowNotification;
use App\Notifications\WelcomeNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

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

}
