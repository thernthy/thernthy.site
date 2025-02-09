@extends('layouts.front')

@section('title', 'Contact Me')

@section('styles')
<style>
/* Animated Border Effect */
    .active-animation {
        border: 2px dashed transparent;
        position: relative;
        animation: border-dance 1.5s infinite linear;
    }

    .active-animation:before,
    .active-animation:after {
        content: "";
        position: absolute;
        z-index: -1;
        width: calc(100% + 10px);
        height: calc(100% + 10px);
        top: -5px;
        left: -5px;
        background-image: 
            linear-gradient(90deg, #ddd 50%, transparent 50%), 
            linear-gradient(90deg, #ddd 50%, transparent 50%), 
            linear-gradient(0deg, #ddd 50%, transparent 50%), 
            linear-gradient(0deg, #ddd 50%, transparent 50%);
        background-repeat: repeat-x, repeat-x, repeat-y, repeat-y;
        background-size: 10px 2px, 10px 2px, 2px 10px, 2px 10px;
        background-position: left top, right bottom, left bottom, right top;
        animation: border-dance 1.5s infinite linear;
    }

/* Animated Border Keyframes */
    @keyframes border-dance {
        0% {
            background-position: left top, right bottom, left bottom, right top;
        }
        100% {
            background-position: left 10px top, right 10px bottom, left bottom 10px, right top 10px;
        }
    }

/* Input Hover and Focus Effects */
    input, textarea {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    input:hover, textarea:hover, input:focus, textarea:focus {
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        transform: scale(1.02);
    }

/* Button Hover and Animation */
    button:hover {
        background-position: right center;
    }
</style>

@endsection

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-white shadow-lg rounded-lg border-2 border-transparent relative active-animation overflow-hidden">
    <!-- Page Title -->
    <h1 class="text-4xl font-bold mb-6 text-gray-800 text-center">Any Inquiries Accepted!</h1>

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

    <!-- Contact Form -->
    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Name Input -->
        <div>
            <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Name</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-transform duration-300 transform hover:scale-105" 
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
                class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-transform duration-300 transform hover:scale-105" 
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
                class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-transform duration-300 transform hover:scale-105" 
                placeholder="Enter your message" 
                required
            ></textarea>
        </div>

        <!-- Submit Button -->
        <div>
            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-blue-500 to-indigo-500 text-white py-3 rounded-md font-semibold shadow-lg hover:bg-blue-600 hover:shadow-xl transition-transform duration-300 transform hover:scale-105"
            >
                Send
            </button>
        </div>
    </form>
</div>
@endsection
