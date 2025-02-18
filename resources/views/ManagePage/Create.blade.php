<x-app-layout>
    <div class="mx-auto h-screen shadow-xl px-2 pt-2" style="background:#02194fe0; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
        <!-- Display Success and Error Messages -->
        <div id="messageWrapper">
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4" id="successMessage">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-4" id="errorMessage">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <form id="pageForm">
            <div class="flex justify-start gap-4 items-center mb-2">
                <div class="search_wraper flex space-x-4 items-center">
                    <select id="language" class="bg-transparent text-white shadow-md" style="background:#02174e; border-radius: 8px; border: 1px solid #02192f00;">
                        <option value="en">English</option>
                        <option value="kh">Khmer</option>
                    </select>
                    <input type="text" id="pageTitle" placeholder="Page title" class="text-white bg-transparent shadow-md" style="border-radius: 8px; border: 1px solid #02192f00;" required />
                </div>
                
                <!-- Translate Switch -->
                <div class="print_rows_wrapper flex items-center space-x-4 p-4 py-2 rounded-lg shadow-md bg-transparent">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <div class="relative">
                            <input type="checkbox" id="translateSwitch" class="sr-only peer" />
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
                            @foreach ($pages as $page)
                            <option value="{{ $page->page_id }}">{{ $page->page_slug }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <!-- Public Switch -->
                <div class="print_rows_wrapper flex items-center space-x-4 p-4 py-2 rounded-lg shadow-md bg-transparent">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <div class="relative">
                            <input type="checkbox" id="publicSwitch" class="sr-only peer" />
                            <div class="w-10 h-6 bg-gray-600 rounded-full shadow-inner transition duration-150 ease-in-out peer-checked:bg-blue-600"></div>
                            <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow-md transform transition-transform duration-150 ease-in-out peer-checked:translate-x-4"></div>
                        </div>
                        <span class="text-white font-medium">Public</span>
                    </label>
                </div>

                <button type="submit" class="px-3 shadow-md rounded-md py-2 text-white bg-blue-600 hover:bg-blue-700">Save</button>
            </div>

            <!-- CodeMirror Editor -->
            <x-code-editor id="codeEditor" code="" name="code" label="Enter Your Code" mode="xml" />
        </form>
    </div>

    <!-- Add necessary CSS and JS libraries for CodeMirror -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.0/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.0/theme/monokai.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.0/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.0/mode/xml/xml.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const translateSwitch = document.getElementById("translateSwitch");
            const relatedPageWrapper = document.querySelector(".print_rows_wraper"); // Wrapper div of the select

            function toggleRelatedPageVisibility() {
                if (translateSwitch.checked) {
                    relatedPageWrapper.style.display = "flex"; // Show when checked
                } else {
                    relatedPageWrapper.style.display = "none"; // Hide when unchecked
                }
            }

            // Initial check on page load
            toggleRelatedPageVisibility();

            // Event listener for change
            translateSwitch.addEventListener("change", toggleRelatedPageVisibility);

            // Initialize CodeMirror only after the page is fully loaded
            const editorElement = document.getElementById("codeEditor");
            const codeEditor = CodeMirror.fromTextArea(editorElement, {
                mode: "xml",
                theme: "monokai",
                lineNumbers: true,
                autoCloseTags: true,
            });

            // Form submission handler
            document.getElementById("pageForm").addEventListener("submit", async function(event) {
                event.preventDefault();

                const data = {
                    title: document.getElementById("pageTitle").value,
                    language: document.getElementById("language").value,
                    translate: document.getElementById("translateSwitch").checked ? 1 : 0,
                    public: document.getElementById("publicSwitch").checked ? 1 : 0,
                    related_page: document.getElementById("relatedPage").value,
                    code: codeEditor.getValue() // Getting the value from CodeMirror
                };

                try {
                    const response = await fetch("{{ route('page_manager.created') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();
                    const messageWrapper = document.getElementById("messageWrapper");

                    // Clear existing messages
                    messageWrapper.innerHTML = "";

                    if (response.ok) {
                        // Display success message dynamically
                        const successMessage = document.createElement("div");
                        successMessage.classList.add("bg-green-500", "text-white", "p-4", "rounded", "mb-4");
                        successMessage.textContent = "Page created successfully!";
                        messageWrapper.appendChild(successMessage);

                        // Reset the form data
                        document.getElementById("pageForm").reset(); // This will reset all form inputs

                        // Reset CodeMirror content
                        codeEditor.setValue(""); // Reset the CodeMirror editor
                    } else {
                        // Display error message dynamically
                        const errorMessage = document.createElement("div");
                        errorMessage.classList.add("bg-red-500", "text-white", "p-4", "rounded", "mb-4");
                        errorMessage.textContent = result.message || "An error occurred. Please try again.";
                        messageWrapper.appendChild(errorMessage);
                    }
                } catch (error) {
                    console.error("API Error:", error);
                    const messageWrapper = document.getElementById("messageWrapper");
                    
                    // Clear existing messages
                    messageWrapper.innerHTML = "";

                    // Display error message dynamically
                    const errorMessage = document.createElement("div");
                    errorMessage.classList.add("bg-red-500", "text-white", "p-4", "rounded", "mb-4");
                    errorMessage.textContent = "Failed to create page. Please try again.";
                    messageWrapper.appendChild(errorMessage);
                }
            });
        });

    </script>
</x-app-layout>
