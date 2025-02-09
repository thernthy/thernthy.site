@extends('admin.layout')

@section('title', 'Contact Messages')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
        <h1 class="text-3xl font-bold mb-6 sm:mb-0 text-gray-800">Contact Messages</h1>
    </div>

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-4">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-100 text-gray-600">
                    <th class="py-2 px-4 border-b text-left text-xs sm:text-sm">#</th>
                    <th class="py-2 px-4 border-b text-left text-xs sm:text-sm">Name</th>
                    <th class="py-2 px-4 border-b text-left text-xs sm:text-sm">Email</th>
                    <th class="py-2 px-4 border-b text-left text-xs sm:text-sm">Message</th>
                    <th class="py-2 px-4 border-b text-left text-xs sm:text-sm">Received At</th>
                    <th class="py-2 px-4 border-b text-left text-xs sm:text-sm">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($messages as $message)
                    <tr class="transition-transform transform hover:scale-105 duration-300 ease-in-out hover:bg-gray-50">
                        <td class="py-2 px-4 border-b text-xs sm:text-sm">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4 border-b text-xs sm:text-sm">{{ $message->name }}</td>
                        <td class="py-2 px-4 border-b text-xs sm:text-sm">{{ $message->email }}</td>
                        <td class="py-2 px-4 border-b text-xs sm:text-sm">{{ \Illuminate\Support\Str::limit($message->message, 50) }}</td>
                        <td class="py-2 px-4 border-b text-xs sm:text-sm">{{ $message->created_at->format('d M Y') }}</td>
                        <td class="py-2 px-4 border-b text-xs sm:text-sm">
                            <a href="{{ route('admin.messages.show', $message->id) }}" class="text-blue-500 hover:text-blue-700 font-semibold transition-colors duration-300">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            @if ($messages->isEmpty())
                <tr>
                    <td colspan="6" class="py-2 px-4 border-b text-center text-xs sm:text-sm">No messages available.</td>
                </tr>
            @endif
        </table>
    </div>

    <div class="flex items-center space-x-4 mt-8 mb-6 sm:mb-0">
        <a href="{{ route('admin.dashboard') }}" class="inline-block bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition-colors duration-300"> <-- Back to Admin Panel</a>
    </div>
</div>
@endsection
