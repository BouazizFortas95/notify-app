<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class CartComponent extends Component
{
    use WithPagination;


    public function render()
    {
        $products = Product::where('id', '<', 23)->paginate(12);

        return view('livewire.cart-component', compact('products'));
    }
}
