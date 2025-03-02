@extends('layouts.front')

@section('title')
    {!! $blog->title !!}
@endsection

@section('style')

<style>
    #nav-swiper-animate {
        height: 100px;
        width: 200px;
        background: linear-gradient(90deg, blue 50%, transparent 50%), 
                    linear-gradient(90deg, blue 50%, transparent 50%), 
                    linear-gradient(0deg, blue 50%, transparent 50%), 
                    linear-gradient(0deg, blue 50%, transparent 50%);
        background-repeat: repeat-x, repeat-x, repeat-y, repeat-y;
        background-size: 15px 4px, 15px 4px, 4px 15px, 4px 15px;
        background-position: 0px 0px, 200px 100px, 0px 100px, 200px 0px;
        padding: 10px;
        animation: border-dance 4s infinite linear;
    }

    @keyframes border-dance {
        0% {
            background-position: 0px 0px, 300px 116px, 0px 150px, 216px 0px;
        }
        100% {
            background-position: 300px 0px, 0px 116px, 0px 0px, 216px 150px;
        }
    }

    .swiper-container {
        width: 100%;
        overflow: hidden;
    }

    .swiper-wrapper {
        display: flex;
        overflow: hidden;
        margin: 0;
        padding: 0;
    }

    .swiper-slide {
        flex: 0 0 100%;
        max-width: 100%;
        text-align: center;
        margin: 0;
        padding: 0;
    }

    .swiper-slide img {
        width: 100%;
        height: auto; /* Automatically scale height to maintain aspect ratio */
        object-fit: cover;
        display: block;
        border-radius: 5px;
    }

    img, video {
        max-width: 100%; /* Prevent overflow beyond the container */
        height: auto;    /* Maintain aspect ratio */
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        img, video {
            height: auto;
        }

        .swiper-slide img {
            height: 250px; /* Adjust height for tablets */
        }

        iframe {
            height: 300px; /* Adjust iframe height */
        }
    }

    @media (max-width: 480px) {
        img, video {
            height: auto;
        }

        .swiper-slide img {
            height: 200px; /* Adjust height for phones */
        }

        iframe {
            height: 200px; /* Adjust iframe height */
        }

        #nav-swiper-animate {
            height: 50px; /* Make navigation buttons smaller for mobile */
            width: 100px;
        }
    }
</style>

@endsection


@section('content')
<section class="hero section dark-white px-4 pt-4">
        <!-- Blog Title -->
        <h1 class="text-4xl font-bold mb-6 text-white">{!! $blog->title !!}</h1>

        <!-- Blog Metadata -->
        <div class="flex items-center space-x-4 mb-8">
            <!-- Author -->
            <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                By {{ $blog->author }}
            </span>
            <!-- Updated At -->
            <span class="bg-gray-200 text-white px-3 py-1 rounded-full text-sm">
                Updated {{ $blog->updated_at->diffForHumans() }}
            </span>
        </div>

        <!-- Featured Image -->
        @if ($blog->image_url)
            <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="w-full h-96 object-cover rounded-lg mb-8">
        @endif

        <!-- Blog Content -->
        <div class="prose max-w-none text-white">
            @if (isset($pagebody))
                {!! $pagebody !!} <!-- Display page_body if available -->
            @else
                {!! $blog->content !!} <!-- Fallback to blog content -->
            @endif
        </div>

        <!-- Divider -->
        <hr class="my-8 border-t border-gray-200">

        <!-- Disqus Comments Section -->
        <div id="disqus_thread" class="mt-8"></div>
</section>
@endsection

@push('scripts')
    <!-- Disqus Script -->
    <script>
        (function() {
            var d = document, s = d.createElement('script');
            s.src = 'https://thernthy-site.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</script>
@endpush


