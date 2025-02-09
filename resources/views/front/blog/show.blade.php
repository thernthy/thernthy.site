@extends('layouts.front')

@section('title')
    {!! $post->title !!}
@endsection

@section('style')

<style>
    #nav-swiper-animate {
        height: 100px;
        width: 200px;
        background: linear-gradient(90deg, blue 50%, transparent 50%), 
                    linear-gradient(90deg, blue 50%, transparent 50%), 
                    linear-gradient(0deg, blue 50%, transparent 50%), 
                    linear-gradient(0deg, blue 50%, transparent 50%);
        background-repeat: repeat-x, repeat-x, repeat-y, repeat-y;
        background-size: 15px 4px, 15px 4px, 4px 15px, 4px 15px;
        background-position: 0px 0px, 200px 100px, 0px 100px, 200px 0px;
        padding: 10px;
        animation: border-dance 4s infinite linear;
    }

    @keyframes border-dance {
        0% {
            background-position: 0px 0px, 300px 116px, 0px 150px, 216px 0px;
        }
        100% {
            background-position: 300px 0px, 0px 116px, 0px 0px, 216px 150px;
        }
    }

    .swiper-container {
        width: 100%;
        overflow: hidden;
    }

    .swiper-wrapper {
        display: flex;
        overflow: hidden;
        margin: 0;
        padding: 0;
    }

    .swiper-slide {
        flex: 0 0 100%;
        max-width: 100%;
        text-align: center;
        margin: 0;
        padding: 0;
    }

    .swiper-slide img {
        width: 100%;
        height: auto; /* Automatically scale height to maintain aspect ratio */
        object-fit: cover;
        display: block;
        border-radius: 5px;
    }

    img, video {
        max-width: 100%; /* Prevent overflow beyond the container */
        height: auto;    /* Maintain aspect ratio */
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        img, video {
            height: auto;
        }

        .swiper-slide img {
            height: 250px; /* Adjust height for tablets */
        }

        iframe {
            height: 300px; /* Adjust iframe height */
        }
    }

    @media (max-width: 480px) {
        img, video {
            height: auto;
        }

        .swiper-slide img {
            height: 200px; /* Adjust height for phones */
        }

        iframe {
            height: 200px; /* Adjust iframe height */
        }

        #nav-swiper-animate {
            height: 50px; /* Make navigation buttons smaller for mobile */
            width: 100px;
        }
    }
</style>

@endsection


@section('content')
<div class="container mx-auto max-w-screen-lg px-4 py-2">
    <!-- Blog Post Title -->
    <h1 class="text-4xl font-bold mb-6">{!! $post->title !!}</h1>

    <!-- Blog Post Author -->
    <span class="text-gray-600 mb-4 bg-yellow-500 p-2">By {{ $post->author }}</span>
    <span class="text-gray-600 mb-4 bg-gray-200 p-2"> -  {{ $post->updated_at->diffForHumans() }}</span>

    <!-- Blog Post Content --> 
    <p class="text-lg text-gray-700 mb-6">{!! $post->content !!}</p> 

    <!-- Image -->

    @if (!empty($post->images) && is_array(json_decode($post->images, true)))
    <div class="swiper-container mb-8">
        <div class="swiper-wrapper">
            @foreach (json_decode($post->images) as $image)
                @if (!empty($image))
                <div class="swiper-slide">
                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $post->title }}" class="rounded-lg">
                </div>
                @endif
            @endforeach
        </div>
        <!-- <div class="swiper-pagination"></div> -->
        <!-- Custom Navigation Buttons -->
        
        <div class="flex justify-center mt-4 space-x-4">
            <button id="nav-swiper-animate" class="swiper-custom-prev px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600 transition">
                < --
            </button>
            <button id="nav-swiper-animate" class="swiper-custom-next px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600 transition">
                -- >
            </button>
        </div>
        
        
    </div>
    @elseif ($post->image)
        <div class="mb-6">
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="rounded-lg">
        </div>
    @endif

    <!-- Video -->
    @if ($post->video_url)
        <div class="mb-6 mt-6">
            <iframe 
                src="{{ $post->video_url }}" 
                frameborder="0" 
                allowfullscreen 
                class="w-full h-full rounded-lg shadow-lg"
            ></iframe>
        </div>
    @endif
    <br>
    <!-- Back to Home Button -->
    <a href="{{ route('blog.index') }}" class="inline-block px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition duration-300">
        ← Back to Blog Lists
    </a>

    <!-- Divider -->
    <br class="border-gray-300 my-8">

    <!-- Contact Form -->
    <div class="bg-white shadow-md rounded-lg p-6 mt-12">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Contact the Author</h2>
        
        <!-- Notification -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <strong class="font-bold">Success!</strong>
                <span class="block">{{ session('success') }}</span>
            </div>
        @elseif(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <strong class="font-bold">Error!</strong>
                <span class="block">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Name Input -->
            <div>
                <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Enter your name"
                    required
                >
            </div>

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Enter your email"
                    required
                >
            </div>

            <!-- Message Input -->
            <div>
                <label for="message" class="block text-sm font-bold text-gray-700 mb-2">Message</label>
                <textarea 
                    name="message" 
                    id="message" 
                    rows="6" 
                    class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Enter your message"
                    required
                ></textarea>
            </div>

            <!-- Submit Button -->
            <div>
                <button 
                    type="submit" 
                    class="w-full bg-blue-500 text-white py-3 rounded-md font-semibold hover:bg-blue-600 transition duration-300"
                >
                    Send
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const swiper = new Swiper('.swiper-container', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 0,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-custom-next',
                prevEl: '.swiper-custom-prev',
            },
            effect: 'fade', // Optional fade effect
            fadeEffect: {
                crossFade: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                1024: {
                    slidesPerView: 1,
                    spaceBetween: 5,
                },
            }
        });
    });

</script>
@endpush


