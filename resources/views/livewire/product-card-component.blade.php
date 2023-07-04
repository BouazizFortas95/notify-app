<div  class="group">
    <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
        <img src="{{ asset('assets/images/digital_'.$item_id.'.jpg') }}"
            alt="Tall slender porcelain bottle with natural clay textured body and cork stopper."
            class="h-full w-full object-cover object-center group-hover:opacity-75">
    </div>
    <div class="flex justify-between p-4 items-center">
        <h3 class="mt-4 text-sm text-gray-700">{{$item_id}}-# {{$name}}</h3>
        <p class="mt-1 text-lg font-medium text-gray-900 w-100">$ {{$price}}</p>
        @unless ($alreadyAdded > 0)
        <button
            class="border border-green-600 hover:bg-green-600 px-3 py-2 m-1 rounded-full text-green-600 hover:text-white"
            wire:click='add2Cart({{$item_id}})' style="outline: none !important">Add</button>
        @else
        <button class="border border-red-600 hover:bg-red-600 px-3 py-2 m-1 rounded-full text-red-600 hover:text-white text-sm"
        wire:click='removeFromCart({{$item_id}}) 'style="outline: none !important">Remove</button>
        @endunless

    </div>
</div>
