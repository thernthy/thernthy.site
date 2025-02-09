@extends('admin.layout')

@section('title', 'Edit | Home Page Content')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Section</h1>
    <form action="{{ route('admin.home.update', $content->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')
        <div>   
            <label for="section_title" class="block font-medium">Title (require) : <i class="text-sm text-gray-500">recommend normal text.</i> </label>
            <input type="text" name="section_title" id="section_title" class="border rounded w-full py-2 px-3" value="{{ old('section_title', $content->section_title) }}">
        </div>
        <div>
            <label for="section_content" class="block font-medium">Content (require) : <i class="text-sm text-gray-500">recommend with HTML & Tailwind code.</i> </label>
            <textarea name="section_content" id="section_content" class="border rounded w-full py-2 px-3">{{ old('section_content', $content->section_content) }}</textarea>
        </div>
        <div>
            <label for="images" class="block text-sm font-bold mb-2">Upload Multiple Images</label>
            <input type="file" name="images[]" id="images" multiple class="w-full border-gray-300 p-2 rounded">
        </div>
        @if($content->images)
        <div class="mt-4">
            <h3 class="font-medium mb-2">Current Images</h3>
            <div class="grid grid-cols-3 gap-4">
                @foreach(json_decode($content->images, true) as $image)
                <div class="relative">
                    <img src="{{ asset('storage/' . $image) }}" alt="Image" class="w-full h-32 object-cover rounded shadow">
                    <form action="{{ route('admin.home.deleteImage', $content->id) }}" method="POST" class="absolute top-2 right-2">
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
        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded mt-8">Save</button>
        <a href="{{ route('admin.home') }}" class="inline-block bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition-colors duration-300">Cancel</a>
    </form>
</div>
@endsection

@push('scripts')
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
