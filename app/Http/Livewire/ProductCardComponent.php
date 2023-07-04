<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;

class ProductCardComponent extends Component
{
    public $item_id;
    public $name;
    public $price;

    public function mount($item){
        $this->item_id = $item->id;
        $this->name = $item->name;
        $this->price = $item->price;
    }

    function add2Cart($id){
        Cart::create([
            'user_id' => auth()->user()->id,
            'product_id' => $this->item_id
        ]);

        $this->emit('updateCartCounter');

    }

    function removeFromCart($id){
        $cart = Cart::whereUserId(auth()->user()->id);
        $cart = $cart->whereProductId($this->item_id)->get()[0];
        $cart->delete();
        $this->emit('updateCartCounter');
    }
    public function render()
    {
        return view('livewire.product-card-component', [
            'alreadyAdded' => Cart::where('product_id', $this->item_id)->count()
        ]);
    }
}
