<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta property="og:image" content="https://thernthy.site/web_profile.jpg">
    <meta property="og:title" content="THERNTHY | HOME">
    <meta property="og:title" content="ធឿន​ ​ធី | Full Stack Developer">
    <meta property="og:description" content="Full Stack Developer and Dog Lover">
    <meta property="og:url" content="{{url('/')}}">
    <meta property="og:type" content="website">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script> 
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Favicons -->
    {{-- <link href="{{ asset('assets/thy/img/apple-touch-icon.png') }}" rel="apple-touch-icon"> --}}
    <link rel="icon" href="/web_profile.jpg" type="image/x-icon">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/thy/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/thy/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/thy/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/thy/css/main.css') }}" rel="stylesheet">
    <!-- Meta Tags -->

    <!-- Icon Scritp -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    {{-- Swiper slider --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    @php
        use App\Models\SiteMeta;
        $locale = app()->getLocale(); // Get the current locale
        $keywords = SiteMeta::where('meta_key', 'keywords')->where('locale', $locale)->value('meta_value');
        $description = SiteMeta::where('meta_key', 'description')->where('locale', $locale)->value('meta_value');
        $title = SiteMeta::where('meta_key', 'title')->where('locale', $locale)->value('meta_value');
    @endphp
    <title>{{$title}}|@yield('title', $title)</title>
    <meta name="keywords" content="{{ $keywords }}, ធឿន​ ​ធី, Thernthy, Software Developer, Full Stack, Web Developer">
    <meta name="description" content="{{ $description }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    @yield('styles')
    {{-- meta hader token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="font-sans antialiased dark-white">
    @include('layouts.header')
    <main class="main">
        <div class="mx-auto">
            <div class="flex justify-center gap-2 py-2">
                <!-- English Button -->
                <a href="{{ route('language.switch', 'en') }}"
                   class="py-1 px-4 shadow-md rounded-md cursor-pointer
                          {{ session()->get('locale') == 'en' ? 'bg-[#3b82f6] text-white' : '' }}">
                    English
                </a>
        
                <!-- Khmer Button -->
                <a href="{{ route('language.switch', 'kh') }}"
                   class="py-1 px-4 shadow-md rounded-md cursor-pointer
                          {{ session()->get('locale') == 'kh' ? 'bg-[#3b82f6] text-white' : '' }}">
                    Khmer
                </a>
            </div>
        </div>
        @yield('content')
    </main>
    @include('layouts.footer')
    @stack('scripts')
    <!--<div class="fixed bottom-3 right-2 live-chart-wrapper ">
        <div class="message-body h-full flex-col justify-end p-4 rounded-lg shadow-md w-full max-w-lg mx-auto">
            
            <div class="message space-y-2 flex flex-col transition-all duration-500 bar-white overflow-y-hidden hover:overflow-y-auto max-h-96 p-4">
                <div class="bg-blue-500 text-white p-3 rounded-lg self-start w-fit shadow-md">
                    Hey, dir 
                </div>
                <div class="bg-white text-gray-900 p-3 rounded-lg self-end w-fit shadow-md">
                  Yoo, you sure about that?
                </div>
                <div class="bg-blue-500 text-white p-3 rounded-lg self-start w-fit shadow-md">
                    Owner message
                </div>
                <div class="bg-white text-dark p-3 rounded-lg self-end w-fit shadow-md">
                    Client message
                </div>
                <div class="bg-blue-500 text-white p-3 rounded-lg self-start w-fit shadow-md">
                    Owner message
                </div>
                <div class="bg-blue-500 text-white p-3 rounded-lg self-start w-fit shadow-md">
                    Owner message
                </div>
            </div>
            <div class="sendder flex items-center gap-2 p-2 bg-white border-t mt-4 rounded-b-lg">
                <input 
                    type="text" 
                    placeholder="Type a message..." 
                    class="flex-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <button class="p-2 bg-blue-500 rounded-full hover:bg-blue-600 transition">
                    <svg width="32px" height="32px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.1168 12.1484C19.474 12.3581 19.9336 12.2384 20.1432 11.8811C20.3528 11.5238 20.2331 11.0643 19.8758 10.8547L19.1168 12.1484ZM6.94331 4.13656L6.55624 4.77902L6.56378 4.78344L6.94331 4.13656ZM5.92408 4.1598L5.50816 3.5357L5.50816 3.5357L5.92408 4.1598ZM5.51031 5.09156L4.76841 5.20151C4.77575 5.25101 4.78802 5.29965 4.80505 5.34671L5.51031 5.09156ZM7.12405 11.7567C7.26496 12.1462 7.69495 12.3477 8.08446 12.2068C8.47397 12.0659 8.67549 11.6359 8.53458 11.2464L7.12405 11.7567ZM19.8758 12.1484C20.2331 11.9388 20.3528 11.4793 20.1432 11.122C19.9336 10.7648 19.474 10.6451 19.1168 10.8547L19.8758 12.1484ZM6.94331 18.8666L6.56375 18.2196L6.55627 18.2241L6.94331 18.8666ZM5.92408 18.8433L5.50815 19.4674H5.50815L5.92408 18.8433ZM5.51031 17.9116L4.80505 17.6564C4.78802 17.7035 4.77575 17.7521 4.76841 17.8016L5.51031 17.9116ZM8.53458 11.7567C8.67549 11.3672 8.47397 10.9372 8.08446 10.7963C7.69495 10.6554 7.26496 10.8569 7.12405 11.2464L8.53458 11.7567ZM19.4963 12.2516C19.9105 12.2516 20.2463 11.9158 20.2463 11.5016C20.2463 11.0873 19.9105 10.7516 19.4963 10.7516V12.2516ZM7.82931 10.7516C7.4151 10.7516 7.07931 11.0873 7.07931 11.5016C7.07931 11.9158 7.4151 12.2516 7.82931 12.2516V10.7516ZM19.8758 10.8547L7.32284 3.48968L6.56378 4.78344L19.1168 12.1484L19.8758 10.8547ZM7.33035 3.49414C6.76609 3.15419 6.05633 3.17038 5.50816 3.5357L6.34 4.78391C6.40506 4.74055 6.4893 4.73863 6.55627 4.77898L7.33035 3.49414ZM5.50816 3.5357C4.95998 3.90102 4.67184 4.54987 4.76841 5.20151L6.25221 4.98161C6.24075 4.90427 6.27494 4.82727 6.34 4.78391L5.50816 3.5357ZM4.80505 5.34671L7.12405 11.7567L8.53458 11.2464L6.21558 4.83641L4.80505 5.34671ZM19.1168 10.8547L6.56378 18.2197L7.32284 19.5134L19.8758 12.1484L19.1168 10.8547ZM6.55627 18.2241C6.4893 18.2645 6.40506 18.2626 6.34 18.2192L5.50815 19.4674C6.05633 19.8327 6.76609 19.8489 7.33035 19.509L6.55627 18.2241ZM6.34 18.2192C6.27494 18.1759 6.24075 18.0988 6.25221 18.0215L4.76841 17.8016C4.67184 18.4532 4.95998 19.1021 5.50815 19.4674L6.34 18.2192ZM6.21558 18.1667L8.53458 11.7567L7.12405 11.2464L4.80505 17.6564L6.21558 18.1667ZM19.4963 10.7516H7.82931V12.2516H19.4963V10.7516Z" fill="#ffffff"/>
                    </svg>
                </button>
            </div>
        </div>
        <div id="live-chart-controll" class="cursor-pointer">
            <svg fill="#ffffff" height="30px" width="30px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                viewBox="0 0 458 458" xml:space="preserve">
                <g>
                    <g>
                        <path d="M428,41.534H30c-16.569,0-30,13.431-30,30v252c0,16.568,13.432,30,30,30h132.1l43.942,52.243
                            c5.7,6.777,14.103,10.69,22.959,10.69c8.856,0,17.258-3.912,22.959-10.69l43.942-52.243H428c16.568,0,30-13.432,30-30v-252
                            C458,54.965,444.568,41.534,428,41.534z M323.916,281.534H82.854c-8.284,0-15-6.716-15-15s6.716-15,15-15h241.062
                            c8.284,0,15,6.716,15,15S332.2,281.534,323.916,281.534z M67.854,198.755c0-8.284,6.716-15,15-15h185.103c8.284,0,15,6.716,15,15
                            s-6.716,15-15,15H82.854C74.57,213.755,67.854,207.039,67.854,198.755z M375.146,145.974H82.854c-8.284,0-15-6.716-15-15
                            s6.716-15,15-15h292.291c8.284,0,15,6.716,15,15C390.146,139.258,383.43,145.974,375.146,145.974z"/>
                    </g>
                </g>
            </svg>
        </div>
    </div>-->
<!-- Vendor JS Files -->
<script src="{{ asset('assets/thy/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/thy/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets/thy/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/thy/vendor/typed.js/typed.umd.js') }}"></script>
<script src="{{ asset('assets/thy/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/thy/vendor/waypoints/noframework.waypoints.js') }}"></script>
<script src="{{ asset('assets/thy/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/thy/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/thy/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/thy/vendor/swiper/swiper-bundle.min.js') }}"></script>

<script src="{{ asset('assets/thy/js/main.js') }}"></script>
    <script>
        const LivechartControll = document.getElementById('live-chart-controll');
        const LivechartWrapper = document.getElementsByClassName('live-chart-wrapper')[0];
        if (LivechartControll && LivechartWrapper) {
        LivechartControll.addEventListener('click', function () {
            LivechartWrapper.classList.toggle('active');

            // Check if the wrapper is active
            if (LivechartWrapper.classList.contains('active')) {
            LivechartControll.innerHTML = `
                <svg width="30px" height="30px" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>cancel</title>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="work-case" fill="#ffffff" transform="translate(91.520000, 91.520000)">
                    <polygon id="Close" points="328.96 30.2933333 298.666667 0 164.48 134.4 30.2933333 0 0 30.2933333 134.4 164.48 0 298.666667 30.2933333 328.96 164.48 194.56 298.666667 328.96 328.96 298.666667 194.56 164.48"></polygon>
                    </g>
                </g>
                </svg>
            `;
            } else {
            // Revert to the original SVG
            LivechartControll.innerHTML = `
                <svg fill="#ffffff" height="30px" width="30px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 458 458" xml:space="preserve">
                <g>
                    <g>
                    <path d="M428,41.534H30c-16.569,0-30,13.431-30,30v252c0,16.568,13.432,30,30,30h132.1l43.942,52.243c5.7,6.777,14.103,10.69,22.959,10.69c8.856,0,17.258-3.912,22.959-10.69l43.942-52.243H428c16.568,0,30-13.432,30-30v-252C458,54.965,444.568,41.534,428,41.534z M323.916,281.534H82.854c-8.284,0-15-6.716-15-15s6.716-15,15-15h241.062c8.284,0,15,6.716,15,15S332.2,281.534,323.916,281.534z M67.854,198.755c0-8.284,6.716-15,15-15h185.103c8.284,0,15,6.716,15,15s-6.716,15-15,15H82.854C74.57,213.755,67.854,207.039,67.854,198.755z M375.146,145.974H82.854c-8.284,0-15-6.716-15-15s6.716-15,15-15h292.291c8.284,0,15,6.716,15,15C390.146,139.258,383.43,145.974,375.146,145.974z"></path>
                    </g>
                </g>
                </svg>
            `;
            }
        });
        } 
        document.querySelector('.sendder button').addEventListener('click', function () {
            let messageInput = document.querySelector('.sendder input');
            let message = messageInput.value.trim();

            if (message.length === 0) return;

            fetch('/live-chat/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ message: message })
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    messageInput.value = '';
                    loadMessages();
                }
            });
        });

        function loadMessages() {
            fetch('/live-chat/messages')
                .then(response => response.json())
                .then(messages => {
                    let chatBox = document.querySelector('.message');
                    chatBox.innerHTML = '';
                    messages.forEach(msg => {
                        let msgDiv = document.createElement('div');
                        msgDiv.classList.add('p-3', 'rounded-lg', 'shadow-md', 'w-fit');
                        msgDiv.classList.add(msg.is_from_user ? 'self-end bg-white text-dark' : 'self-start bg-blue-500 text-white');
                        msgDiv.textContent = msg.message;
                        chatBox.appendChild(msgDiv);
                    });
                });
        }
        //setInterval(loadMessages, 5000);
  </script>
</body>
</html>
