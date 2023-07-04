<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;

class CartCounter extends Component
{
    protected $listeners  = ['updateCartCounter' => 'noop'];

    function noop() { }
    public function render()
    {
        return view('livewire.cart-counter', ['count' => Cart::whereUserId(auth()->user()->id)->count()]);
    }
}
