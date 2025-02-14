@php
use App\Models\Page;
$locale = session()->get('locale') ?? 'en'; // Default to 'en' if session is empty
$pagebody = Page::where('page_url', '/about')->where('locale', $locale)->first();
@endphp

<!-- Hero Section -->
<section id="hero" class="hero section dark-white px-4 pt-4">
    @if (!$pagebody)
        <h2>Page not found</h2>
    @else
        {!! $pagebody->page_body !!}
    @endif
</section>
