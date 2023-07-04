<div class="grid container m-6 mb-6 mt-6">
    <div class="bg-white">
        <h2 class="m-6 text-2xl font-semibold text-black-700 dark:text-black-200">
            Cart
        </h2>
        <hr>
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 xl:gap-x-8">
                @foreach ($products as $item)
                @livewire('product-card-component', ['item' => $item], key($item->id))
                @endforeach
                <!-- More products... -->
            </div>
        </div>
        <hr>
        {{$products->links()}}
    </div>
</div>
