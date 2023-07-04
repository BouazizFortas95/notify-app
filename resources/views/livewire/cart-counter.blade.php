<div>
    <span class="inline-flex rounded-md">
        <label
            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">

            <img src="{{ asset('assets/images/cart.ico') }}" alt="" class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            <!-- Notification badge -->
            <span aria-hidden="true"
                class="absolute top-0 right-0 inline-block w-3 h-3 rounded-full text-red-600">{{$count}}</span>

        </label>
    </span>
</div>
