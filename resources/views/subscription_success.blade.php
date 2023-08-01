<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscribtion Success') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-300 p-3 m-2">
                 <h5>Successfull subscription with Stripe.</h5>
            </div>
        </div>
    </div>
</x-app-layout>
