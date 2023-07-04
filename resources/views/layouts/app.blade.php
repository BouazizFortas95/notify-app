<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer=""></script>
    <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
    {{-- Trix assets --}}
    @trixassets

</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>

            <!-- This is an example component -->
            <div class="event-notify-box flex mt-6 right-0 top-0 mt-3 mr-3 px-5 py-3 rounded-sm shadow-lg fixed transform duration-700 opacity-0">
                <div class="m-auto">
                    <div class="bg-white rounded-lg border-gray-300 border p-3 shadow-lg">
                        <div class="flex flex-row">
                            <div class="px-2">
                                <svg width="24" height="24" viewBox="0 0 1792 1792" fill="#44C997"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1299 813l-422 422q-19 19-45 19t-45-19l-294-294q-19-19-19-45t19-45l102-102q19-19 45-19t45 19l147 147 275-275q19-19 45-19t45 19l102 102q19 19 19 45t-19 45zm141 83q0-148-73-273t-198-198-273-73-273 73-198 198-73 273 73 273 198 198 273 73 273-73 198-198 73-273zm224 0q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z" />
                                </svg>
                            </div>
                            <div class="ml-2 mr-6 event-notify-content">
                                {{-- <span class="font-semibold">Successfully Saved!</span>
                                <span class="block text-gray-500">Anyone with a link can now view this file</span> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')
    @livewireScripts

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

    {{-- <script>
        /*
         * Initialize a Web Socket client
        */
        function clientSocket(config = {}) {
            let route = config.route || "127.0.0.1";
            let port = config.port || "3280";

            window.Websocket = window.WebSocket || window.MozWebSocket;
            return new Websocket("ws://"+route+":"+port);
        }

        // initialize a connection
        var connection = clientSocket();

        /*
        * the event listener that will be dispatched th the websocket server
        */
        window.addEventListener('event-notify', event => {

            connection.send(JSON.stringify({
                eventName: event.detail.eventName,
                eventMessage: event.detail.eventMessage
            }));
            // alert('Event Message : '+event.detail.eventMessage);
        });

        // when the connection is open
        connection.onopen = function () {
            console.log("Connection is Open!!");
        }

        connection.onmessage = function (message) {
            var result = JSON.parse(message.data);
            var notifyMessage = `<span class="font-semibold">${result.eventName}</span>
            <span class="block text-gray-500">${result.eventMessage}</span>`;
            // console.log(result);

            // Begin animation - display message
            $(".event-notify-content").html(notifyMessage);
            $(".event-notify-box").removeClass("opacity-0");
            $(".event-notify-box").addClass("opacity-100");

            // hide after 3 seconds
            setTimeout(() => {
                $(".event-notify-box").removeClass("opacity-100");
                $(".event-notify-box").addClass("opacity-0");
            }, 3000);
         }

          // when the connection is close
        connection.onclose = function () {
            console.log("Connection was close!!");
            console.log("Reconnecting after 3 seconds...");
            setTimeout(() => {
                window.location.reload();
            }, 3000);
        }
    </script> --}}
</body>

</html>
