@extends('admin.layout')

@section('title', 'Edit | Blog Post')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-700 mb-6">Edit Post</h1>
    <form action="{{ route('admin.blog.update', $posts->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <em class="text-sm text-red-500 mb-4 font-bold ">Note: Title & Content could be both text or html-tailwind code.</em>
            <br>
            <label for="title" class="block text-sm font-medium text-gray-700">Title (required) : Recommend Normal Text </label>
            <input type="text" name="title" id="title" value="{{ $posts->title }}" 
                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('title', $posts->title) }}" required>
        </div>

        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">Content (required) : Recommend Tailwind & Html Code </label>
            <textarea name="content" id="content" rows="10" 
                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('content', $posts->content) }}</textarea>
        </div>

        <div>
            <label for="images" class="block text-sm font-bold mb-2">Upload Multiple Images</label>
            <input type="file" name="images[]" id="images" multiple class="w-full border-gray-300 p-2 rounded">
        </div>

        @if($posts->images)
        <div class="mt-4">
            <h3 class="font-medium mb-2">Current Images</h3>
            <div class="grid grid-cols-3 gap-4">
                @foreach(json_decode($posts->images, true) as $image)
                <div class="relative">
                    <img src="{{ asset('storage/' . $image) }}" alt="Image" class="w-full h-32 object-cover rounded shadow">
                    <form action="{{ route('admin.blog.deleteImage', $posts->id) }}" method="POST" class="absolute top-2 right-2">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="image" value="{{ $image }}">
                        <button type="submit" class="bg-red-500 text-white rounded mt-4 mb-4 p-1 hover:bg-red-700">
                            Delete
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        <br>
        <div class="mb-4">
            <label for="video_url" class="block text-sm font-medium text-gray-700">Video URL (work in progress)</label>
            <input type="url" name="video_url" id="video_url" value="{{ old('video_url', $posts->video_url) }}" 
                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="slug" class="block text-sm font-medium text-gray-700">Slug (required): Slug mean, a unique identifier for the post URL in the browser address bar.</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $posts->slug) }}" 
                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="author" class="block text-sm font-medium text-gray-700">Author (optional but if you do not fill this field, the default author < Unknown > will be used) </label>
            <input type="text" name="author" id="author" value="{{ old('author', $posts->author) }}" 
                class="form-control mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-500 transition" data-image="{{ $posts->images }}">
            Update Post
        </button>

        <a href="{{ route('admin.blog') }}" class="inline-block bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition-colors duration-300"> Cancel </a>

    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        // Drag-and-drop functionality with preview
        const dropArea = document.getElementById('drop-area');
        const imagesInput = document.getElementById('images');
        const previewArea = document.getElementById('preview-area');

        dropArea.addEventListener('click', () => imagesInput.click());

        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropArea.classList.add('border-gray-500');
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('border-gray-500');
        });

        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.classList.remove('border-gray-500');
            const files = e.dataTransfer.files;
            handleFiles(files);
        });

        imagesInput.addEventListener('change', (e) => {
            const files = e.target.files;
            handleFiles(files);
        });

        function handleFiles(files) {
            [...files].forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('w-full', 'h-auto', 'object-cover', 'rounded', 'shadow');
                        previewArea.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });

</script>
@endpush
