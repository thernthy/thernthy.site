@extends('admin.layout')

@section('title', 'View | Contact Message')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Contact Message</h1>

    <div class="bg-white shadow-lg rounded-lg p-6">
        <p class="text-lg text-gray-700 mb-4"><strong>Name:</strong> {{ $message->name }}</p>
        <p class="text-lg text-gray-700 mb-4"><strong>Email:</strong> {{ $message->email }}</p>
        <p class="text-lg text-gray-700 mb-4"><strong>Message:</strong></p>
        <p class="text-gray-600">{{ $message->message }}</p>
    </div>

    <div class="mt-8">
        <a href="{{ route('admin.messages') }}" class="inline-block bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition-colors duration-300"> <-- Back to Messages</a>
    </div>
</div>
@endsection
