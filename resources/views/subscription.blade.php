<x-app-layout>
    <!-- Snippet -->
    <section class="flex flex-col justify-center antialiased bg-gray-100 text-gray-600 min-h-screen">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-12 gap-6">
                <!-- Tab 1 -->
                <form action="{{ route('subscribtion.create') }}" method="POST" id="payment-form"
                    class="relative col-span-full md:col-span-12 bg-white shadow-md rounded-sm border border-gray-200">
                    @csrf
                    <input type="hidden" name="plan" id="plan" value="{{$plan->id}}">
                    <div class="absolute top-0 left-0 right-0 h-0.5 bg-green-500" aria-hidden="true"></div>
                    <div class="px-5 pt-5 pb-6 border-b border-gray-200">
                        <header class="flex items-center mb-2">
                            <div
                                class="w-6 h-6 rounded-full flex-shrink-0 bg-gradient-to-tr from-green-500 to-green-300 mr-3">
                                <svg class="w-6 h-6 fill-current text-white" viewBox="0 0 24 24">
                                    <path
                                        d="M12 17a.833.833 0 01-.833-.833 3.333 3.333 0 00-3.334-3.334.833.833 0 110-1.666 3.333 3.333 0 003.334-3.334.833.833 0 111.666 0 3.333 3.333 0 003.334 3.334.833.833 0 110 1.666 3.333 3.333 0 00-3.334 3.334c0 .46-.373.833-.833.833z" />
                                </svg>
                            </div>
                            <h3 class="text-lg text-gray-800 font-semibold">{{$plan->name}}</h3>
                        </header>
                        <div class="text-sm mb-2">{{$plan->description}}</div>
                        <!-- Price -->
                        <div class="text-gray-800 font-bold mb-4">
                            <span class="text-2xl">DZD</span><span class="text-3xl"
                                x-text="annual ? '14' : '19'">{{$plan->amount}}</span><span
                                class="text-gray-500 font-medium text-sm">/{{$plan->stripe_plane ==
                                'price_1NYx1bCMzwK43ih2C4K8jpvg'?'Year':'Task'}}</span>
                        </div>
                    </div>
                    <div class="px-5 pt-4 pb-5">
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-12">
                                <label for="card-holder-name"
                                    class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        {{-- <span
                                            class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">{{env('APP_URL')}}/</span>
                                        --}}
                                        <input type="text" name="name" id="card-holder-name" autocomplete="name"
                                            class="block w-full flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="janesmith">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-12">
                                <label for="card-element"
                                    class="block text-sm font-medium leading-6 text-gray-900">Card Info</label>
                                <div class="mt-2" id="card-element"></div>
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button type="submit" id="card-button" data-secret="{{$intent->client_secret}}"
                                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    </div>

    <script src="https://unpkg.com/tailwindcss-jit-cdn"></script>
    <!-- Specify a custom Tailwind configuration -->
    <script type="tailwind-config">
        {
            theme: {
                extend: {
                colors: {
                    blue: colors.sky,
                }
                }
            }
            }
    </script>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{env('STRIPE_KEY')}}")

        const elements = stripe.elements()
        const cardElement = elements.create('card')

        cardElement.mount('#card-element')

        const form = document.getElementById('payment-form')
        const cardBtn = document.getElementById('card-button')
        const cardHolderName = document.getElementById('card-holder-name')

        form.addEventListener('submit', async (e) => {
            e.preventDefault()

            cardBtn.disabled = true
            const {setupIntent, error} = await stripe.confirmCardSetup(
                cardBtn.dataset.secret, {
                payment_method: {
                    card: cardElement,
                    billing_details:{
                        name: cardHolderName.value
                    }
                }
            })


            if (error) {
                cardBtn.disabled = false
            } else {
                let token = document.createElement('input')
                token.setAttribute('type', 'hidden')
                token.setAttribute('name', 'token')
                token.setAttribute('value', setupIntent.payment_method)
                form.appendChild(token)
                form.submit()
            }
        })
    </script>

</x-app-layout>
