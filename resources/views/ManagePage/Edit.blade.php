<x-app-layout>

<style>
    body{
        overflow-y: none;
    }
    div.cm-s-monokai.CodeMirror{
        background:transparent !important;
        height: 100%;
        width: 100%;
    }
    div.cm-s-monokai .CodeMirror-gutters{
        background:transparent !important;
    }
    div.CodeMirror-hscrollbar::-webkit-scrollbar-track{
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: transparent !important;
    }
    div.CodeMirror-hscrollbar::-webkit-scrollbar
    {
        width: 1px !important;
        height: 8px;
        background-color: transparent !important;
    }
    div.CodeMirror-hscrollbar::-webkit-scrollbar-thumb
    {
        background-color: #ffffff !important;
    }
</style>
    <div class="mx-auto h-screen overflow-y-auto px-2 pb-10 shadow-xl" style="background:#02194fe0; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
        <div class="py-2 data_filter_wraper flex flex-row items-center justify-between shadow-md header_" style="color: #fff;">
            <div>
                <a href="{{ route('manager') }}" class="text-green-300">manager/</a>
                <span>{{ $page->page_slug }}</span>
            </div>

            <!-- Use proper JSON encoding for page_body -->
            <div class="tools_wraper pr-2">
                <!-- Edit Button -->
                <button id="editModeButton" class="px-4 py-1 rounded-md border border-blue-400 text-blue-400" onclick="startEditing()">
                    Edit
                </button>

                <!-- Save Edit Button -->
                <button  type="button" id="saveButton" onclick="saveEdit()" class="px-4 py-1 rounded-full border border-blue-400 text-green-400" style="display: none;">
                &#10003;
                </button>

                <!-- Demo View Button (hidden initially) -->
                <button  type="button" id="demoViewButton" onclick="toggleDemoView()" class="px-4 py-1 rounded-full border border-blue-400 text-yellow-400" style="display: none;">
                    Demo Show
                </button>

                <!-- Cancel Button that toggles between new edit ask interface and original edit -->
                <button  type="button" id="cancelButton" onclick="cancelEdit()" class="px-4 py-1 rounded-full border border-blue-400 text-red-400" style="display: none;">
                 &#10005;
                </button>
            </div>
        </div>

        <div class="pt-4">
            <!-- Show Content (if not in editing mode) -->
            <div id="contentDisplay" class=">
                <div id="contentText" class="white">
                        {!! $page->page_body !!}
                </div>
            </div>

            <!-- Editable Section with CodeMirror (if in editing mode) -->
            <div id="contentEdit" style="display: none;">
                <div class="flex justify-start gap-4 items-center mb-2">
                    <div class="search_wraper flex space-x-4 items-center">
                        <select id="language" class="bg-transparent text-white shadow-md" style="background:#02174e; border-radius: 8px; border: 1px solid #02192f00;">
                            <option value="en" {{ $page->locale == 'en' ? 'selected' : '' }}>English</option>
                            <option value="kh" {{ $page->locale == 'kh' ? 'selected' : '' }}>Khmer</option>
                        </select>

                        <input type="text" id="pageTitle" value="{{ $page->page_slug }}" placeholder="Page title" class="text-white bg-transparent shadow-md" style="border-radius: 8px; border: 1px solid #02192f00;" required />
                    </div>

                    <div class="search_wraper flex space-x-4 items-center">
                        <select id="root_path" class="bg-transparent text-white shadow-md" style="background:#02174e; border-radius: 8px; border: 1px solid #02192f00;">
                            <option value="/" {{ $page->root_path == '/' ? 'selected' : '' }}>index</option>
                            <option value="blogs" {{ $page->root_path == 'blogs' ? 'selected' : '' }}>blogs</option>
                            <option value="knowlendge" {{ $page->root_path == 'knowlendge' ? 'selected' : '' }}>knowlendge</option>
                            <option value="support" {{ $page->root_path == 'support' ? 'selected' : '' }}>support</option>
                        </select>
                    </div>
                    
                    <!-- Translate Switch -->
                    <div class="print_rows_wrapper flex items-center space-x-4 p-4 py-2 rounded-lg shadow-md bg-transparent">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <div class="relative">
                                <input type="checkbox" id="translateSwitch" class="sr-only peer" {{ $page->rela_page? 'checked' : '' }} />
                                <div class="w-10 h-6 bg-gray-600 rounded-full shadow-inner transition duration-150 ease-in-out peer-checked:bg-blue-600"></div>
                                <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow-md transform transition-transform duration-150 ease-in-out peer-checked:translate-x-4"></div>
                            </div>
                            <span class="text-white font-medium">Translate</span>
                        </label>
                    </div>

                    <div class="print_rows_wraper flex space-x-4">
                        <select id="relatedPage" class="text-white bg-transparent shadow-md" style="background:#02174e; border-radius: 8px; border: 1px solid #02192f00;">
                            <option value="">Select Page Related For</option>
                            @if(isset($pages))
                                @foreach ($pages as $item)
                                <option value="{{ $item->page_id }}" {{ $page->page_slug == $item->page_slug ? 'selected' : '' }}>{{ $item->page_slug }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Public Switch -->
                    <div class="print_rows_wrapper flex items-center space-x-4 p-4 py-2 rounded-lg shadow-md bg-transparent">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <div class="relative">
                                <input type="checkbox" id="publicSwitch" class="sr-only peer" 
                                    {{ $page->status == 1 ? 'checked' : '' }} />
                                <div class="w-10 h-6 bg-gray-600 rounded-full shadow-inner transition duration-150 ease-in-out peer-checked:bg-blue-600"></div>
                                <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow-md transform transition-transform duration-150 ease-in-out peer-checked:translate-x-4"></div>
                            </div>
                            <span class="text-white font-medium">Public</span>
                        </label>
                    </div>
                </div>
                <div id="contentTextarea" class="w-full h-full hp-2 border rounded" style="height: 100%;"></div>
            </div>

            <!-- Rendered Demo View (if demo mode is on) -->
            <div id="demoView" class="h-full" style="display: none;">
                <div id="demoContentText" class="border p-4 rounded">
                    {!! $page->page_body !!}
                </div>
            </div>
        </div>
    </div>
    <!-- Add necessary CSS and JS libraries for CodeMirror -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.0/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.0/theme/monokai.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.0/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.0/mode/xml/xml.min.js"></script>
    <script>
    let originalContent = {!! json_encode($page->page_body) !!};
    let editor; // Declare editor variable globally to access in other functions

    // Initialize CodeMirror when the page is loaded or when switching to edit mode
    function startEditing() {
        document.getElementById('contentDisplay').style.display = 'none';
        document.getElementById('contentEdit').style.display = 'block';
        document.getElementById('saveButton').style.display = 'inline-block';
        document.getElementById('cancelButton').style.display = 'inline-block';
        document.getElementById('editModeButton').style.display = 'none';
        document.getElementById('demoViewButton').style.display = 'inline-block';

        // Initialize CodeMirror editor if it's not already initialized
        if (!editor) {
            editor = CodeMirror(document.getElementById("contentTextarea"), {
                value: originalContent,
                mode: "xml", // Use the HTML mode, you can change this depending on your needs
                lineNumbers: true,
                theme: "monokai", // Set the theme to 'dracula' or any other theme you like
                matchBrackets: true,
                autoCloseTags: true,
                lineWrapping: true
            });
        }
    }

    function saveEdit() {
        const content = editor.getValue();

        fetch("{{ route('page_manager.modifyed', ['slug' => $page->page_slug]) }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ page_body: content, page_id:'{{ $page->page_id }}' })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('contentText').innerHTML = content;
                document.getElementById('contentDisplay').style.display = 'block';
                document.getElementById('contentEdit').style.display = 'none';
                document.getElementById('editModeButton').style.display = 'inline-block';
                document.getElementById('saveButton').style.display = 'none';
                document.getElementById('cancelButton').style.display = 'none';
                document.getElementById('demoViewButton').style.display = 'none';
            }
        })
        .catch(error => console.error("Error:", error));
    }

    function cancelEdit() {
        editor.setValue(originalContent); // Reset the content to the original one
        document.getElementById('contentDisplay').style.display = 'block';
        document.getElementById('contentEdit').style.display = 'none';
        document.getElementById('editModeButton').style.display = 'inline-block';
        document.getElementById('saveButton').style.display = 'none';
        document.getElementById('cancelButton').style.display = 'none';
        document.getElementById('demoViewButton').style.display = 'none';
    }

    // Function to toggle Demo View
    function toggleDemoView() {
        const contentEdit = document.getElementById('contentEdit');
        const contentDisplay = document.getElementById('contentDisplay');
        const demoView = document.getElementById('demoView');
        const demoContentText = document.getElementById('demoContentText');
        const demoViewButton = document.getElementById('demoViewButton');
        if (demoView.style.display === 'none') {
            contentDisplay.style.display = 'none';
            contentEdit.style.display = 'none';
            demoView.style.display = 'block';
            demoContentText.innerHTML = editor.getValue();
            demoViewButton.innerHTML = 'Back to Edit';
        } else {
            // Switch back to edit view
            demoView.style.display = 'none';
            contentDisplay.style.display = 'none';
            contentEdit.style.display = 'block';
            demoViewButton.innerHTML = 'Demo Show'; 
        }
    }
</script>

</x-app-layout>
