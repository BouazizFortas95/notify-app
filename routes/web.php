<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscribtionController;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\Pricing;
use App\Http\Livewire\Subscription;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');
Route::get('/notify',[ HomeController::class, 'notify'])->name('notify');
Route::get('/sendSMS', [HomeController::class, 'sendSMS']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/pages', function () {
        return view('admin.pages');
    })->name('pages');

    Route::get('/cart', CartComponent::class)->name('cart');

    Route::get('/pricing', Pricing::class)->name('pricing');

    Route::get('/pricing/{plan:slug}', [SubscribtionController::class, 'show'])->name('pricing.plan');
    Route::post('/subscribtion', [SubscribtionController::class, 'create'])->name('subscribtion.create');

});
