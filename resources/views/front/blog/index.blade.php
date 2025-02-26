@extends('layouts.front')

@section('title', 'Blog Posts')

@section('styles')
    <!-- Custom Scrollbar Animation -->
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
@endsection

@section('content')
<div class="py-12">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Grid Container -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
      @if($posts->isEmpty())
          <h4 class="text-rend text-center">NO POST</h4>
       @else
          @foreach ($posts as $blog)
          <div class="shadow-lg rounded-lg overflow-hidden flex flex-col">
                <a href="{{ url('blog',['view',$blog->slug]) }}">
                    <!-- Featured Image -->
                    <img class="w-full h-48 object-cover" src="{{ $blog->cover_image }}" alt="{{ $blog->title }}">

                    <!-- Card Content -->
                    <div class="p-6 flex flex-col flex-grow">
                        <!-- Title -->
                        <h2 class="text-xl font-semibold mb-2">
                            {{ $blog->title }}
                        </h2>

                        <!-- Description with Ellipsis -->
                        <p class="text-gray-500 mb-4 overflow-hidden overflow-ellipsis line-clamp-3">
                          @if (isset($pagebody))
                              {!! $pagebody !!} <!-- Display page_body if available -->
                          @else
                              {!! $blog->content !!} <!-- Fallback to blog content -->
                          @endif
                        </p>

                        <!-- Metadata (Author and Date) -->
                        <div class="text-sm text-gray-500 mt-auto">
                            <span>By {{ $blog->author }}</span> <!-- Assuming author is a relationship -->
                            <span> • </span>
                            <span>{{ $blog->created_at->format('F j, Y') }}</span> <!-- Format the date -->
                        </div>
                    </div>
                  </a>
              </div>

          @endforeach
        @endif


                  <!-- Card 1 -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden flex flex-col">
          <!-- Featured Image -->
          <img class="w-full h-48 object-cover" src="https://blog.resellerspanel.com/wp-content/uploads/2018/10/multiple-domain-names-for-a-business-website.png" alt="How to Point a Domain to a Server">
  
          <!-- Card Content -->
          <div class="p-6 flex flex-col flex-grow">
            <!-- Title -->
            <h2 class="text-xl font-semibold text-gray-900 mb-2">
              How to Point a Domain to a Server
            </h2>
  
            <!-- Description with Ellipsis -->
            <p class="text-gray-600 mb-4 overflow-hidden overflow-ellipsis line-clamp-3">
                Get Server IP Address: Obtain the IP address of your server (e.g., from your hosting provider).
                Access Domain DNS Settings:
                Log in to your domain registrar account (e.g., GoDaddy, Namecheap).
                Navigate to the DNS management section for your domain.
                Update DNS Records:
                Find the A Record (Address Record).
                Change the Value or Points To field to your server’s IP address.
                Save the changes.
                Wait for Propagation:
                DNS changes can take 24-48 hours to propagate globally.
                Verify:
                Use tools like DNS Checker or ping your domain to confirm it points to the server.
                That’s it! Your domain is now pointing to your server.
            </p>
  
            <!-- Metadata (Author and Date) -->
            <div class="text-sm text-gray-500 mt-auto">
              <span>By Thy</span>
              <span> • </span>
              <span>October 15, 2025</span>
            </div>
          </div>
        </div>
        <!-- Card 1 -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden flex flex-col">
          <!-- Featured Image -->
          <img class="w-full h-48 object-cover" src="https://miro.medium.com/v2/resize:fit:3200/0*zeRxucTaTJETPnx6" alt="Blog Post Image">
  
          <!-- Card Content -->
          <div class="p-6 flex flex-col flex-grow">
            <!-- Title -->
            <h2 class="text-xl font-semibold text-gray-900 mb-2">
              The Ultimate Guide to Tailwind CSS
            </h2>
  
            <!-- Description with Ellipsis -->
            <p class="text-gray-600 mb-4 overflow-hidden overflow-ellipsis line-clamp-3">
              Tailwind CSS is a utility-first CSS framework that allows you to build custom designs quickly without writing custom CSS. It provides a set of low-level utility classes that you can use to style your components directly in your HTML.
            </p>
  
            <!-- Metadata (Author and Date) -->
            <div class="text-sm text-gray-500 mt-auto">
              <span>By John Doe</span>
              <span> • </span>
              <span>October 5, 2023</span>
            </div>
          </div>
        </div>
  
        <!-- Card 2 -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden flex flex-col">
          <img class="w-full h-48 object-cover" src="https://ideacdn.net/idea/ct/82/myassets/blogs/css-nedir-css3.jpg?revision=1581695062" alt="Blog Post Image">
          <div class="p-6 flex flex-col flex-grow">
            <h2 class="text-xl font-semibold text-gray-900 mb-2">
              Mastering Responsive Design
            </h2>
            <p class="text-gray-600 mb-4 overflow-hidden overflow-ellipsis line-clamp-3">
              Responsive design is essential for modern web development. Learn how to use Tailwind CSS to create layouts that look great on all devices, from mobile to desktop.
            </p>
            <div class="text-sm text-gray-500 mt-auto">
              <span>By Jane Smith</span>
              <span> • </span>
              <span>October 6, 2023</span>
            </div>
          </div>
        </div>
  
        <!-- Card 3 -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden flex flex-col">
          <img class="w-full h-48 object-cover" src="https://techcrunch.com/wp-content/uploads/2015/04/codecode.jpg?w=1024">
          <div class="p-6 flex flex-col flex-grow">
            <h2 class="text-xl font-semibold text-gray-900 mb-2">
              Advanced Tailwind Techniques
            </h2>
            <p class="text-gray-600 mb-4 overflow-hidden overflow-ellipsis line-clamp-3">
              Dive into advanced Tailwind CSS techniques like customizing your theme, creating reusable components, and optimizing for performance.
            </p>
            <div class="text-sm text-gray-500 mt-auto">
              <span>By Alex Johnson</span>
              <span> • </span>
              <span>October 7, 2023</span>
            </div>
          </div>
        </div>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden flex flex-col">
          <img class="w-full h-48 object-cover" src="https://avatars.githubusercontent.com/u/117651861?v=4">
          <div class="p-6 flex flex-col flex-grow">
            <h2 class="text-xl font-semibold text-gray-900 mb-2">
              Hello
            </h2>
            <p class="text-gray-600 mb-4 overflow-hidden overflow-ellipsis line-clamp-3">
              I’m a Full Stack Developer and a dog lover with a passion for crafting elegant, user-friendly digital experiences. I specialize in working as the Lead Designer at server-side APIs, UX/UI design, and backend development.
            </p>
            <div class="text-sm text-gray-500 mt-auto">
              <span>Thy</span>
              <span> • </span>
              <span>October 7, 2023</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection



