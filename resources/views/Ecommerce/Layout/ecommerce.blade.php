
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SalinioDrug')</title>

        <!-- Favicon from the web -->
        <link rel="icon" type="image/svg+xml" href='data:image/svg+xml,
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="10" fill="white" stroke="black" stroke-width="2"/>
        <path d="M8 12l2 2 4-4" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>'>


        <!-- Scripts -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}" defer></script>

        <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" type="text/css" />
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

        {{-- <!-- Bootstrap css -->
        <link href="{{ asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" /> --}}


            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
            <!-- Page-specific CSS -->

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >




                    {{-- OVERRIDING STYLING CHROME BEHAVIOR  --}}

        <style>

            input:-webkit-autofill,
            input:-webkit-autofill:hover,
            input:-webkit-autofill:focus {
            -webkit-text-fill-color: #111827; /* gray-900 */
            box-shadow: 0 0 0px 1000px white inset;
            transition: background-color 9999s ease-in-out 0s;
            }


        </style>


        @livewireStyles
        

</head>





<body class="bg-gray-100 overflow-x-hidden">



<!-- GLOBAL FULLSCREEN LOADER -->
<div id="global-loader" aria-hidden="true"
     class="hidden fixed inset-0 z-[9999] items-center justify-center bg-black bg-opacity-60"
     style="display:none; pointer-events:auto;">
    <div class="flex flex-col items-center">
        <svg class="animate-spin h-14 w-14 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
        <p class="text-white mt-4 text-lg font-semibold">Processing — please wait…</p>
    </div>
</div>

    <!-- Header -->
        {{--  FOR NAVIGATION --}}
    @include('Ecommerce.Layout.navigation')



    {{-- <!-- Page Content -->
<main class="w-screen px-0 py-0 m-0">
    @yield('content')

    <!-- Floating Chat -->
<chaindesk-chatbox-standard id="chaindesk-chat" style="position: fixed; bottom: 20px; right: 20px; width: 350px; height: 500px; z-index: 9999;"></chaindesk-chatbox-standard>

@section('scripts')

@php
  $customer = auth()->guard('customer')->user();
@endphp




@if($customer)
<script type="module">
    import Chatbox from 'https://cdn.jsdelivr.net/npm/@chaindesk/embeds@latest/dist/chatbox/index.js';

    const widget = await Chatbox.initBubble({
        agentId: 'cmkwkmatx0d2lq1utoiuk0zg6',

        contact: {
        firstName: @json($customer->name),
        email: @json($customer->email),
        userId: @json('customer_'.$customer->id),
        },

        context: `
    You are chatting with a logged-in customer named {{ $customer->name }}.
    Rules:
    - Keep answers short and direct.
    - Avoid unnecessary explanations.
    - Encourage the user to ask short, clear questions.
    - Be helpful but concise.
        `,
    });

        widget.open();

</script>
@endif




{{-- 
<script type="module">
  import Chatbox from 'https://cdn.jsdelivr.net/npm/@chaindesk/embeds@latest/dist/chatbox/index.js';

  const widget = await Chatbox.initBubble({
    agentId: 'cmkwkmatx0d2lq1utoiuk0zg6',
    
    // optional 
    // If provided will create a contact for the user and link it to the conversation
    contact: {
      firstName: 'John',
      lastName: 'Doe',
      email: 'customer@email.com',
      phoneNumber: '+33612345644',
      userId: '42424242',
    },
    // optional
    // Override initial messages
    initialMessages: [
      'Hello Georges how are you doing today?',
      'How can I help you ?',
    ],
    // optional
    // Provided context will be appended to the Agent system prompt
    context: "The user you are talking to is John. Start by Greeting him by his name.",

    
  });

  // open the chat bubble
  widget.open();

  // close the chat bubble
  widget.close()

  // or 
  widget.toggle()
</script> --}}
{{-- 
</main> --}} 






<!-- Page Content -->
    <main class="flex-1 px-0 py-0 pb-0 sm:px-6 lg:px-0">

    {{-- 
        <!-- PAGE CONTENT -->
            <main class="flex-1 px-4 py-4 pb-24 sm:px-6 lg:px-10"> --}}



        @yield('content')


        @php
            $customer = auth()->guard('customer')->user();
        @endphp

        <script
            src="https://app.wonderchat.io/scripts/wonderchat-seo.js"
            data-name="wonderchat-seo"
            data-address="app.wonderchat.io"
            data-id="cmkxnhttc0n0wi5krxp0dqty9"
            data-widget-size="small"
            data-widget-button-size="normal"

            {{-- Visitor data --}}
            @if($customer)
                data-user-id="customer_{{ $customer->id }}"
                data-user-name="{{ $customer->name }}"
                data-user-email="{{ $customer->email }}"
            @endif

            defer
        ></script>



</main>


    @include('Ecommerce.Layout.footer')



    {{-- <script src="//code.tidio.co/au57g5xkzazysz5agqbkco57fgcbk67n.js" async></script>

    @php
        $customer = auth()->guard('customer')->user();
    @endphp

    <script>
        window.tidioChatApi = window.tidioChatApi || [];
        window.tidioChatApi.push(function() {

            // Set visitor info
            @if($customer)
            window.tidioChatApi.setVisitorData({
                name: @json($customer->name),
                email: @json($customer->email),
                userId: @json('customer_'.$customer->id)
            });
            @endif

            // Change bot name
            window.tidioChatApi.setBotName("Salinio AI");

            // Optional: change bot avatar
            window.tidioChatApi.setBotAvatar("https://example.com/your-bot-avatar.png");

        });
    </script> --}}


    

            <!-- Custom JS -->
    <script src="{{ asset('backend/assets/js/code.js') }}"></script>

    <script src="{{ asset('backend/assets/js/validate.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/validation.js') }}"></script>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>







@if(Session::has('message'))
<div id="toast"
    class="fixed top-5 right-2 max-w-md w-[90%] sm:w-auto bg-white text-gray-900 rounded-2xl shadow-2xl 
           border border-gray-200 p-4 flex items-center gap-3 animate-toast-in"  style="z-index: 9999;">


    <!-- Icon -->
    @if(Session::get('alert-type') === 'success')
        <div class="flex-shrink-0 bg-green-100 p-2 rounded-full">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>
    @elseif(Session::get('alert-type') === 'error')
        <div class="flex-shrink-0 bg-red-100 p-2 rounded-full">
            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
    @elseif(Session::get('alert-type') === 'warning')
        <div class="flex-shrink-0 bg-yellow-100 p-2 rounded-full">
            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M5.07 19h13.86L12 5 5.07 19z" />
            </svg>
        </div>
    @else
        <div class="flex-shrink-0 bg-blue-100 p-2 rounded-full">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20h.01" />
            </svg>
        </div>
    @endif

    
    <!-- Message -->
    <p class="text-sm sm:text-base font-medium flex-1">
        {{ Session::get('message') }}
    </p>

    <!-- Close button -->
    <button onclick="hideToast()" class="text-gray-400 hover:text-gray-600">
        ✕
    </button>

    {{-- <!-- Progress bar -->
    <div id="toast-progress" class="absolute bottom-0 left-0 h-1 bg-current rounded-b-2xl opacity-50"
        style="width: 100%;"></div>
</div> --}}





<script>
    setTimeout(() => {
        document.getElementById('toast').classList.add('hidden');
    }, 3000);
</script>

<style>
    @keyframes slide-in {
        0% { transform: translateX(100%); opacity: 0; }
        100% { transform: translateX(0); opacity: 1; }
    }
    .animate-slide-in {
        animation: slide-in 0.3s ease-out;
    }
</style>
@endif



<script defer src="https://unpkg.com/alpinejs"></script>




<livewire:global-loader />

    @livewireScripts

</body>
</html>
