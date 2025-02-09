@extends('admin.layout')

@section('title', 'Blog Post Management')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-700">All Posts</h1>
        <a href="{{ route('admin.blog.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-500 transition">
            Create New Post
        </a>
    </div>
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead class="bg-gray-100 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Images</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Slug</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Author</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Created At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 text-sm font-medium">{{ $post->title }}</td>
                    <td class="py-6 px-4 border-b">
                    @if (!empty($post->images) && is_array(json_decode($post->images, true)))
                        @foreach (json_decode($post->images) as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="Image" class="w-16 h-16 object-cover mr-2">
                        @endforeach
                    @else
                        <span class="text-gray-500">No images</span>
                    @endif
                    </td>
                    <td class="px-6 py-4 text-sm">{{ $post->slug }}</td>
                    <td class="px-6 py-4 text-sm">{{ $post->author }}</td>
                    <td class="px-6 py-4 text-sm">{{ $post->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-sm">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.blog.edit', $post->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-400 transition">Edit</a>
                            <form action="{{ route('admin.blog.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-400 transition">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No posts available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $posts->links('pagination::tailwind') }}
    </div>
    <div class="flex items-center space-x-4 mt-8 mb-6 sm:mb-0">
        <a href="{{ route('admin.dashboard') }}" class="inline-block bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition-colors duration-300"> <-- Back to Admin Panel</a>
    </div>
</div>
@endsection


