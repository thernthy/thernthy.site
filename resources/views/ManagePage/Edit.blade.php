<x-app-layout>
    <div class="mx-auto h-screen shadow-xl" style="background:#02194fe0; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
        <div class="py-2 data_filter_wraper flex flex-row items-center justify-between shadow-md header_" style="color: #fff;">
            <div>
                <a href="{{ route('manager') }}" class="text-green-300">manager/</a>
                <span>{{ $page->page_slug }}</span>
            </div>

            <!-- Use proper JSON encoding for page_body -->
            <div class="tools_wraper pr-2">
                <button type="button" class="px-4 py-1 rounded-md border border-blue-400 text-blue-400">Remove</button>

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

                <button type="button" class="px-4 py-1 rounded-md border border-blue-400 text-blue-400">Clear Body Content</button>
            </div>
        </div>

        <div class="bg-white pt-4 h-4/5">
            <!-- Show Content (if not in editing mode) -->
            <div id="contentDisplay">
                <div id="contentText">
                    {!! $page->page_body !!}
                </div>
            </div>

            <!-- Editable Textarea (if in editing mode) -->
            <div id="contentEdit" class="h-full" style="display: none;">
                <textarea id="contentTextarea" class="w-full h-full hp-2 border rounded">{{ $page->page_body }}</textarea>
            </div>

            <!-- Rendered Demo View (if demo mode is on) -->
            <div id="demoView" class="h-full" style="display: none;">
                <div id="demoContentText" class="border p-4 rounded">
                    {!! $page->page_body !!}
                </div>
            </div>
        </div>
    </div>

    <script>
        let originalContent = {!! json_encode($page->page_body) !!};

        // Toggle between edit view and demo view
        function toggleDemoView() {
            const contentEdit = document.getElementById('contentEdit');
            const contentDisplay = document.getElementById('contentDisplay');
            const demoView = document.getElementById('demoView');
            const demoContentText = document.getElementById('demoContentText');
            const demoViewButton = document.getElementById('demoViewButton');

            // Switch to demo view
            if (demoView.style.display === 'none') {
                contentDisplay.style.display = 'none';
                contentEdit.style.display = 'none';
                demoView.style.display = 'block';

                // Display the content as it would be rendered
                demoContentText.innerHTML = document.getElementById('contentTextarea').value; // Show the live edit

                // Change Demo View button text
                demoViewButton.innerHTML = 'Back to Edit'; // Change to "Back to Edit" when in demo mode
            } else {
                // Switch back to edit view
                demoView.style.display = 'none';
                contentDisplay.style.display = 'none';
                contentEdit.style.display = 'block';

                // Change Demo View button text back to "Demo Show"
                demoViewButton.innerHTML = 'Demo Show'; // Change to "Demo Show" when in edit mode
            }
        }

        function startEditing() {
            // Hide the displayed content and show the textarea
            document.getElementById('contentDisplay').style.display = 'none';
            document.getElementById('contentEdit').style.display = 'block';
            document.getElementById('saveButton').style.display = 'inline-block';
            document.getElementById('cancelButton').style.display = 'inline-block';
            document.getElementById('editModeButton').style.display = 'none';
            document.getElementById('demoViewButton').style.display = 'inline-block'; // Show Demo View Button
        }

        function saveEdit() {
            const content = document.getElementById('contentTextarea').value;

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
                    // Update the displayed content with the new content
                    document.getElementById('contentText').innerHTML = content;
                    // Hide the textarea and show the content again
                    document.getElementById('contentDisplay').style.display = 'block';
                    document.getElementById('contentEdit').style.display = 'none';
                    document.getElementById('editModeButton').style.display = 'inline-block';
                    document.getElementById('saveButton').style.display = 'none';
                    document.getElementById('cancelButton').style.display = 'none';
                    document.getElementById('demoViewButton').style.display = 'none'; // Hide Demo View Button
                }
            })
            .catch(error => console.error("Error:", error));
        }

        function cancelEdit() {
            // Revert to the original content in edit mode
            document.getElementById('contentTextarea').value = originalContent;
            document.getElementById('contentDisplay').style.display = 'block';
            document.getElementById('contentEdit').style.display = 'none';
            document.getElementById('editModeButton').style.display = 'inline-block';
            document.getElementById('saveButton').style.display = 'none';
            document.getElementById('cancelButton').style.display = 'none';
            document.getElementById('demoViewButton').style.display = 'none'; // Hide Demo View Button
        }
    </script>
</x-app-layout>
