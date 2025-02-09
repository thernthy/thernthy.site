@extends('admin.layout')

@section('title', 'Create | Home Page Content')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Add New Section</h1>
    <form action="{{ route('admin.home.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <em class="text-sm text-red-500 mb-4 font-bold ">Note: Content could be text or html-tailwind code.</em>
            <br>
            <label for="section_title" class="block font-medium">Title (require) : <i class="text-sm text-gray-500">recommend normal text.</i></label>
            <input type="text" name="section_title" id="section_title" class="border rounded w-full py-2 px-3">
        </div>
        <div>
            <label for="section_content" class="block font-medium">Content (require) : <i class="text-sm text-gray-500">recommend with HTML & Tailwind code.</i> </label>
            <textarea name="section_content" id="section_content" class="border rounded w-full py-2 px-3"></textarea>
        </div>
        <div>
            <label for="images" class="block text-sm font-bold mb-2">Upload Multiple Images</label>
            <div id="drop-area" 
                 class="border-dashed border-2 border-gray-300 rounded p-4 text-center cursor-pointer hover:border-gray-500">
                <p class="text-gray-500">Drag and drop images here or click to upload</p>
                <input type="file" name="images[]" id="images" multiple class="hidden">
            </div>
            <div id="preview-area" class="grid grid-cols-3 gap-4 mt-4"></div>
        </div>
        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Save</button>
    
        <a href="{{ route('admin.home') }}" class="inline-block bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition-colors duration-300"> Cancel </a>

    </form>
</div>
@endsection


@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    // document.addEventListener('DOMContentLoaded', () => {
    //     // Initialize TinyMCE
    //     tinymce.init({
    //         selector: 'textarea#section_content', // Target the content textarea
    //         plugins: 'image media link code table fullscreen preview lists',
    //         toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image media | preview fullscreen',
    //         height: 500,
    //         relative_urls: false,
    //         remove_script_host: false,
    //         document_base_url: "{{ url('/') }}", // Adjust to your base URL
    //         content_css: "{{ asset('css/tinymce.css') }}", // Add your custom TinyMCE styles if needed
    //         setup: (editor) => {
    //             editor.on('init', () => {
    //                 editor.setContent('');
    //             });
    //         }
    //     });

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

