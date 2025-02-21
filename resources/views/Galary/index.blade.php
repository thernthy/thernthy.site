<x-app-layout>
    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #4f46e5, #3b82f6);
            border-radius: 4px;
            animation: scrollThumb 2s infinite alternate;
        }

        @keyframes scrollThumb {
            0% { background-color: #3b82f6; }
            100% { background-color: #4f46e5; }
        }
    </style>
    <div id="dropzone" class="mx-auto pb-5 shadow-xl px-4 pt-4" style="background:#02194fe0; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
        <!-- Page Management UI -->
        <div class="data_filter_wrapper header_ text-white mb-5">
            <div class="flex justify-between items-center gap-6">
                <div class="flex space-x-6 items-center">
                    <select class="bg-transparent text-white shadow-md px-4 py-2 rounded-md" title="Filter" style="background:#02174e; border: 1px solid #02192f00;">
                        <option value="page_id">Page ID</option>
                        <option value="page_url">Page URL</option>
                        <option value="Page_name">Page Name</option>
                        <option value="page_body">Page Body</option>
                    </select>
                    <input type="text" placeholder="Search..." title="keyword" class="bg-transparent text-white shadow-md px-4 py-2 rounded-md" style="border-radius: 8px; border: 1px solid #02192f00;" />
                </div>
                <div class="flex space-x-4 items-center">
                    <select class="bg-transparent text-white shadow-md px-4 py-2 rounded-md" title="Rows per page" style="background:#02174e; border: 1px solid #02192f00;">
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <select class="bg-transparent text-white shadow-md px-4 py-2 rounded-md" title="Visibility" style="background:#02174e; border: 1px solid #02192f00;">
                        <option value="Public">Public</option>
                        <option value="Private">Private</option>
                        <option value="Delete">Delete</option>
                    </select>
                    <button class="py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-md">Pass Link</>
                </div>
            </div>
        </div>

        <!-- Image Grid -->
        <div class="galary_wrapper grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($images as $image)
                <!-- Image Card -->
                <div class="relative shadow-lg rounded-lg overflow-hidden flex flex-col">
                    @if (isset($image['url']))
                        <!-- External image -->
                        <img class="w-full h-48 object-cover" src="{{ $image['url'] }}">
                    @elseif (isset($image['path']))
                        <!-- Local image -->
                        <img class="w-full h-48 object-cover" src="{{ $image['path'] }}">
                    @endif


                    <div class="p-4 text-white flex flex-col flex-grow">
                       <span class="text-sm text-gray-300">Uploaded on: {{ now()->format('F d, Y') }}</span>
                        @if (isset($image['url']))
                         <button onclick="copyToClipboard('{{ $image['url'] }}')"
                         class="py-5 px-3 absolute top-3"
                         style="
                             top: -20px;
                             border-radius: 12px 0px 85px 34px;
                             background:#021a50;
                            "
                         >Copy</button>
                        @elseif (isset($image['path']))
                         <button onclick="copyToClipboard('{{ $image['path'] }}')" 
                         class="py-5 px-3 absolute top-3"
                         style="
                             top: -20px;
                             border-radius: 12px 0px 85px 34px;
                             background:#021a50;
                            "
                         >Copy</button>
                        @endif
                    </div>
                </div>
            @endforeach
            <div id="upload-render-wraper" class="upload-render-wraper hidden fixed right-0 px-2 bg-white max-w-sm bottom-0 py-2 max-h-96 overflow-y-auto">
                <ul id="upload-file-list">
                    <!-- Dynamic file list will be appended here -->
                </ul>
            </div>
        </div>

        <!-- Pagination (optional) -->
        @if (count($images) >= $perPage)
            <div class="mt-6 flex justify-center gap-4">
                <a href="{{ url()->current() }}?page={{ $currentPage - 1 }}&per_page={{ $perPage }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Previous</a>
                <a href="{{ url()->current() }}?page={{ $currentPage + 1 }}&per_page={{ $perPage }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Next</a>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const dropzone = document.getElementById("dropzone");
            const uploadRenderWrapper = document.getElementById("upload-render-wraper");
            const uploadFileList = document.getElementById("upload-file-list");

            dropzone.addEventListener("dragover", (e) => {
                e.preventDefault();
                dropzone.classList.add("dragover");
            });

            dropzone.addEventListener("dragleave", () => {
                dropzone.classList.remove("dragover");
            });

            dropzone.addEventListener("drop", (e) => {
                e.preventDefault();
                dropzone.classList.remove("dragover");
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    uploadFile(files[0]);
                }
            });

            function uploadFile(file) {
                uploadRenderWrapper.classList.remove('hidden');

                const listItem = document.createElement('li');
                listItem.classList.add('flex', 'flex-row', 'justify-start', 'gap-2', 'items-center');

                const fileImage = document.createElement('img');
                const reader = new FileReader();
                reader.onload = function(e) {
                    fileImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
                fileImage.classList.add('w-11', 'h-8');
                listItem.appendChild(fileImage);

                const progressWrapper = document.createElement('div');
                progressWrapper.classList.add('iteme-line', 'w-52', 'bg-gray-300', 'h-1.5');
                const progressBar = document.createElement('div');
                progressBar.classList.add('compted-line', 'h-full', 'bg-green-300');
                progressWrapper.appendChild(progressBar);
                listItem.appendChild(progressWrapper);

                uploadFileList.appendChild(listItem);

                const formData = new FormData();
                formData.append("image", file);
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "/manager/upload-image", true);
                xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                xhr.upload.addEventListener("progress", (event) => {
                    if (event.lengthComputable) {
                        const percentUploaded = (event.loaded / event.total) * 100;
                        progressBar.style.width = `${percentUploaded}%`;
                    }
                });

                xhr.onload = function () {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        fetchNewGalaryData()
                        console.log(response.success); 
                    } else {
                        console.error("Error uploading file.");
                    }
                };

                xhr.onerror = function () {
                    console.error("Error during the file upload.");
                };
                xhr.send(formData);
            }

            function fetchNewGalaryData() {
                // Fetching the gallery data from the server
                fetch("{{ route('manager.galary.fechtApi') }}", {
                    method: 'GET',
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        "Content-Type": "application/json" // Ensure the content type is JSON
                    }
                })
                .then(response => response.json()) // Parse the JSON response
                .then(data => {
                    // Check if the data contains 'images' and it's an array
                    if (data && Array.isArray(data.images)) {
                        renderImages(data.images); // Call the function to render the images
                    } else {
                        console.error("Expected 'images' to be an array, but got:", data);
                    }
                })
                .catch(error => {
                    console.error("Error fetching gallery data:", error);
                });
            }


        });

        function renderImages(images) {
            const imageGrid = document.querySelector('.galary_wrapper'); // This is your image grid container
            if (!imageGrid) {
                console.error("Image grid container not found");
                return;
            }

            imageGrid.innerHTML = ''; // Clear any existing images

            // Loop through the image data and render each image
            images.forEach(image => {
                const imageCard = document.createElement('div');
                imageCard.classList.add('relative', 'shadow-lg', 'rounded-lg', 'overflow-hidden', 'flex', 'flex-col');
                // Check if the image has a URL or path
                let imageUrl = '';
                if (image.url) {
                    imageUrl = image.url; // External image
                } else if (image.path) {
                    imageUrl = image.path; // Local image
                }

                console.log(imageUrl); // Check the image URL

                const imgElement = document.createElement('img');
                imgElement.src = imageUrl;
                imgElement.classList.add('w-full', 'h-48', 'object-cover');

                // Add the image to the card
                imageCard.appendChild(imgElement);

                const imageDetails = document.createElement('div');
                imageDetails.classList.add('p-4', 'text-white', 'flex', 'flex-col', 'flex-grow');

                const uploadDate = document.createElement('span');
                uploadDate.classList.add('text-sm', 'text-gray-300');
                uploadDate.textContent = `Uploaded on: ${new Date(image.date).toLocaleDateString()}`;
                imageDetails.appendChild(uploadDate);

                // Add the copy button
                const copyButton = document.createElement('button');
                copyButton.textContent = 'Copy';
                copyButton.onclick = () => copyToClipboard(imageUrl);
                copyButton.classList.add('py-5', 'px-3', 'absolute', 'top-3');
                copyButton.style.cssText = `
                    top: -20px;
                    border-radius: 12px 0px 85px 34px;
                    background: #021a50;
                `;

                imageDetails.appendChild(copyButton);
                imageCard.appendChild(imageDetails);

                // Append the card to the grid
                imageGrid.appendChild(imageCard);
            });
        }




        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => alert("Copied: " + text));
        }
    </script>
</x-app-layout>
