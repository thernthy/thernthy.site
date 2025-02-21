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

        /* Blog Cards Style */

        /* From Uiverse.io by Yaya12085 */ 
        .card {
        box-sizing: border-box;
        display: flex;
        max-width: 300px;
        background-color: rgba(255, 255, 255, 1);
        transition: all .15s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover {
        box-shadow: 10px 10px 30px rgba(0, 0, 0, 0.081);
        }

        .date-time-container {
        writing-mode: vertical-lr;
        transform: rotate(180deg);
        padding: 0.5rem;
        }

        .date-time {
        display: flex;
        align-items: center;
        justify-content: space-between;
        grid-gap: 1rem;
        gap: 1rem;
        font-size: 0.75rem;
        line-height: 1rem;
        font-weight: 700;
        text-transform: uppercase;
        color: rgba(17, 24, 39, 1);
        }

        .separator {
        width: 1px;
        flex: 1 1 0%;
        background-color: rgba(17, 24, 39, 0.1);
        }

        .content {
        display: flex;
        flex: 1 1 0%;
        flex-direction: column;
        justify-content: space-between;
        }

        .infos {
        border-left: 1px solid rgba(17, 24, 39, 0.1);
        padding: 1rem;
        }

        .title {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 18.72px;
        color: rgba(17, 24, 39, 1);
        }

        .description {
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 5;
        line-clamp: 5;
        margin-top: 0.5rem;
        font-size: 0.875rem;
        line-height: 1.25rem;
        color: rgba(55, 65, 81, 1);
        }

        .action {
        display: block;
        background-color: rgba(253, 224, 71, 1);
        padding: 0.75rem 1.25rem;
        text-align: center;
        font-size: 0.75rem;
        line-height: 1rem;
        font-weight: 700;
        text-transform: uppercase;
        color: rgba(17, 24, 39, 1);
        transition: all .15s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .action:hover {
        background-color: rgba(250, 204, 21, 1);
        }

</style>
<div class="mx-auto shadow-xl px-2 pt-2" style="background:#02194fe0; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
    <!-- Page Management UI -->
    <div class=" data_filter_wraper header_" style="color: #fff;">
            <div class="flex justify-start gap-4 items-center mb-5">
                <div class="search_wraper flex space-x-4 items-center">
                    <select class="bg-transparent shadow-md" title="Print Rows" style="background:#02174e; border-radius: 8px; border: 1px solid #02192f00;">
                        <option value="page_id">Page ID</option>
                        <option value="page_url">Page URL</option>
                        <option value="Page_name">Page Name</option>
                        <option value="page_body">Page Body</option>
                    </select>
                    <input type="text" placeholder="Enter Keyword...." title="keyword" class="bg-transparent shadow-md" style="border-radius: 8px; border: 1px solid #02192f00;" />
                </div>
                <div class="print_rows_wraper flex space-x-4">
                    <select placeholder="Print Rows" title="Print Rows" class="bg-transparent shadow-md" style="background:#02174e; border-radius: 8px; border: 1px solid #02192f00;">
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="print_rows_wraper flex space-x-4">
                    <select placeholder="PrintRows" class="bg-transparent shadow-md" title="Print Rows" style="background:#02174e; border-radius: 8px; border: 1px solid #02192f00;">
                        <option value="Public">Public</option>
                        <option value="Private">Private</option>
                        <option value="Delete">Delete</option>
                    </select>
                </div>
                <div class="print_rows_wraper flex space-x-4">
                    <a href="{{ route('manager.blogs.create') }}" class="py-2 px-3 bg-transparent shadow-md rounded-md">Create Page</a>
                </div>
            </div>
    </div>
    <div class="mx-auto">
      <!-- Grid Container -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
       @if($blogs->isEmpty())
          
      @else
          @foreach ($blogs as $blog)
              <div class="shadow-lg rounded-lg overflow-hidden flex flex-col">
                  <!-- Featured Image -->
                  <img class="w-full h-48 object-cover" src="{{ $blog->cover_image }}" alt="{{ $blog->title }}">

                  <!-- Card Content -->
                  <div class="p-6 flex flex-col flex-grow">
                      <!-- Title -->
                      <h2 class="text-xl font-semibold text-white mb-2">
                          {{ $blog->title }}
                      </h2>

                      <!-- Description with Ellipsis -->
                      <p class="text-white mb-4 overflow-hidden overflow-ellipsis line-clamp-3">
                          {!! $blog->content !!}
                      </p>

                      <!-- Metadata (Author and Date) -->
                      <div class="text-sm text-gray-500 mt-auto">
                          <span>By {{ $blog->author }}</span> <!-- Assuming author is a relationship -->
                          <span> • </span>
                          <span>{{ $blog->created_at->format('F j, Y') }}</span> <!-- Format the date -->
                      </div>
                  </div>
              </div>
          @endforeach
        @endif

      </div>
    </div>
  </div>
  </x-app-layout>



