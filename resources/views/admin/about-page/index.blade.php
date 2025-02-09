@extends('admin.layout')

@section('title', 'About Page Management')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">About Page Content</h1>
        <a href="{{ route('admin.about.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
            Add Section
        </a>
    </div>
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Section Title</th>
                <th class="py-2 px-4 border-b">Content</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contents as $content)
            <tr>
                <td class="py-2 px-4 border-b">{{ $content->section_title }}</td>
                <td class="py-2 px-4 border-b">{{ Str::limit($content->section_content, 50) }}</td>
                <td class="py-2 px-4 border-b">
                    <a href="{{ route('admin.about.edit', $content->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-400 transition">Edit</a>
                    <form action="{{ route('admin.about.destroy', $content->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-400 transition">Delete</button>
                    </form>
                </td>
            </tr>             
            @endforeach
        </tbody>
        @if ($contents->isEmpty())
            <tr>
                <td colspan="3" class="py-2 px-4 border-b text-center">No sections available.</td>
            </tr>
        @endif
    </table>
    <div class="flex items-center space-x-4 mt-8 mb-6 sm:mb-0">
        <a href="{{ route('admin.dashboard') }}" class="inline-block bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition-colors duration-300"> <-- Back to Admin Panel</a>
    </div>
</div>
@endsection
