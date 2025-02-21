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
                    <input type="text" id="blogs_title" placeholder="Blog title" class="text-white bg-transparent shadow-md" style="border-radius: 8px; border: 1px solid #02192f00;" required />
                </div>
                <div class="search_wraper flex space-x-4 items-center">
                    <select id="root_path" class="bg-transparent text-white shadow-md" style="background:#02174e; border-radius: 8px; border: 1px solid #02192f00;">
                        <option value="blogs">blogs</option>
                        <option value="knowlendge">knowlendge</option>
                        <option value="support">support</option>
                    </select>
                </div>
                
                <!-- Translate Switch -->
                <div class="print_rows_wrapper flex items-center space-x-4 p-4 py-2 rounded-lg shadow-md bg-transparent">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <div class="relative">
                            <input type="checkbox" id="usePageSwitch" class="sr-only peer" />
                            <div class="w-10 h-6 bg-gray-600 rounded-full shadow-inner transition duration-150 ease-in-out peer-checked:bg-blue-600"></div>
                            <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow-md transform transition-transform duration-150 ease-in-out peer-checked:translate-x-4"></div>
                        </div>
                        <span class="text-white font-medium">Use page</span>
                    </label>
                </div>

                <div class="print_rows_wraper flex space-x-4">
                    <select id="relatedPage" class="text-white bg-transparent shadow-md" style="background:#02174e; border-radius: 8px; border: 1px solid #02192f00;">
                        <option value="">Select Blog Related For</option>
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
            <div class="search_wraper flex space-x-4 items-center"> 
                <input type="text" id="cover_image" placeholder="Cover Picture URL"
                    class="text-white bg-transparent shadow-md" style="border-radius: 8px; border: 1px solid #02192f00;" required />
                <button type="button" id="open_gallery" class="px-3 py-2 shadow-md rounded-md text-gray-300">
                    Select from Server
                </button>
            </div>
            <x-code-editor id="content" code="" name="code" label="Enter your conent" mode="xml" />
        </form>
    </div>

    <!-- Gallery Window -->
    <div class="galary_window fixed top-0 right-0 w-full bg-white h-screen py-14 px-2 overflow-y-auto hidden" id="galary_window"> 
        <div class="galary_wrapper grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Images will be dynamically loaded here -->
        </div>
        <div class="fixed mx-auto bottom-2 left-2/4 -translate-x-1/2">
            <button id="close_gallery" class="px-3 py-2 shadow-sm text-white bg-red-700 rounded-md">Cancel</button>
            <button id="insert_image" class="px-3 py-2 shadow-sm text-white bg-green-700 rounded-md" disabled>Open</button>
        </div>
    </div>

    <!-- Add necessary CSS and JS libraries for CodeMirror -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.0/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.0/theme/monokai.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.0/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.0/mode/xml/xml.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const usePageSwitch = document.getElementById("usePageSwitch");
            const relatedPageWrapper = document.querySelector(".print_rows_wraper"); // Wrapper div of the select

            function toggleRelatedPageVisibility() {
                if (usePageSwitch.checked) {
                    relatedPageWrapper.style.display = "flex"; // Show when checked
                } else {
                    relatedPageWrapper.style.display = "none"; // Hide when unchecked
                }
            }

            // Initial check on page load
            toggleRelatedPageVisibility();

            // Event listener for change
            usePageSwitch.addEventListener("change", toggleRelatedPageVisibility);

            // Initialize CodeMirror only after the page is fully loaded
            const editorElement = document.getElementById("content");
            const codeEditor = CodeMirror.fromTextArea(editorElement, {
                mode: "xml",
                theme: "monokai",
                lineNumbers: true,
                autoCloseTags: true,
            });
        // Form submission handler
        document.getElementById("pageForm").addEventListener("submit", async function(event) {
            event.preventDefault();
            const codeValue = codeEditor.getValue().trim(); // Trim to remove whitespace
            // Validate code field
            if (!codeValue) {
                const messageWrapper = document.getElementById("messageWrapper");

                // Clear existing messages
                messageWrapper.innerHTML = "";

                // Display error message dynamically
                const errorMessage = document.createElement("div");
                errorMessage.classList.add("bg-red-500", "text-white", "p-4", "rounded", "mb-4");
                errorMessage.textContent = "Code content cannot be empty!";
                messageWrapper.appendChild(errorMessage);

                return; // Stop form submission
            }

            const data = {
                title: document.getElementById("blogs_title").value,
                language: document.getElementById("language").value,
                root_path: document.getElementById("root_path").value,
                translate: document.getElementById("usePageSwitch").checked ? 1 : 0,
                public: document.getElementById("publicSwitch").checked ? 1 : 0,
                related_page: document.getElementById("relatedPage").value,
                cover_picture: document.getElementById("cover_image").value,
                code: codeValue // Ensuring code is not empty
            };

            try {
                const response = await fetch("{{ route('manager.blogs.created') }}", {
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
                    // Display success message
                    const successMessage = document.createElement("div");
                    successMessage.classList.add("bg-green-500", "text-white", "p-4", "rounded", "mb-4");
                    successMessage.textContent = "Page created successfully!";
                    messageWrapper.appendChild(successMessage);

                    // Reset the form data
                    document.getElementById("pageForm").reset();
                    codeEditor.setValue(""); // Reset CodeMirror editor
                } else {
                    // Display error message
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

                // Display error message
                const errorMessage = document.createElement("div");
                errorMessage.classList.add("bg-red-500", "text-white", "p-4", "rounded", "mb-4");
                errorMessage.textContent = "Failed to create page. Please try again.";
                messageWrapper.appendChild(errorMessage);
            }
        });
    })
       
        document.addEventListener("DOMContentLoaded", function() {
            const openGalleryButton = document.getElementById("open_gallery");
            const galleryWindow = document.getElementById("galary_window");
            const closeGalleryButton = document.getElementById("close_gallery");
            const insertImageButton = document.getElementById("insert_image");
            const coverImageInput = document.getElementById("cover_image");
            let selectedImageUrl = null;

            // Show the gallery and fetch images
            openGalleryButton.addEventListener("click", function() {
                galleryWindow.classList.remove("hidden");
                fetchNewGalaryData();
            });

            // Close gallery window
            closeGalleryButton.addEventListener("click", function() {
                galleryWindow.classList.add("hidden");
            });

            // Insert the selected image URL into the input field
            insertImageButton.addEventListener("click", function() {
                if (selectedImageUrl) {
                    coverImageInput.value = selectedImageUrl;
                    galleryWindow.classList.add("hidden");
                }
            });

            function fetchNewGalaryData() {
                fetch("{{ route('manager.galary.fechtApi') }}", {
                    method: 'GET',
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data && Array.isArray(data.images)) {
                        renderImages(data.images);
                    } else {
                        console.error("Expected 'images' to be an array, but got:", data);
                    }
                })
                .catch(error => {
                    console.error("Error fetching gallery data:", error);
                });
            }

            function renderImages(images) {
                const imageGrid = document.querySelector('.galary_wrapper');
                imageGrid.innerHTML = ''; // Clear previous images

                images.forEach(image => {
                    const imageCard = document.createElement('div');
                    imageCard.classList.add('relative', 'shadow-lg', 'rounded-lg', 'overflow-hidden', 'flex', 'flex-col', 'cursor-pointer');

                    let imageUrl = image.url || image.path;

                    const imgElement = document.createElement('img');
                    imgElement.src = imageUrl;
                    imgElement.classList.add('w-full', 'h-48', 'object-cover');

                    // Image details
                    const imageDetails = document.createElement('div');
                    imageDetails.classList.add('p-4', 'text-white', 'flex', 'flex-col', 'flex-grow');

                    const uploadDate = document.createElement('span');
                    uploadDate.classList.add('text-sm', 'text-gray-300');
                    uploadDate.textContent = `Uploaded on: ${new Date(image.date).toLocaleDateString()}`;

                    // Append elements
                    imageDetails.appendChild(uploadDate);
                    imageCard.appendChild(imgElement);
                    imageCard.appendChild(imageDetails);
                    imageGrid.appendChild(imageCard);

                    // Click event to select the image
                    imageCard.addEventListener("click", function() {
                        document.querySelectorAll('.galary_wrapper div').forEach(el => el.classList.remove("border-2", "border-blue-500"));
                        imageCard.classList.add("border-2", "border-blue-500");
                        selectedImageUrl = imageUrl;
                        insertImageButton.disabled = false;
                    });
                });
            }
        });
    </script>
</x-app-layout>
