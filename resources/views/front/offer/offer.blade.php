@extends('layouts.front')

@section('title', $page->page_slug??'Demo')


@section('content')
<!-- Hero Section -->
<section id="hero" class="hero section dark-white px-4 pt-4">
    @if (!$page)
        <h2>Page not found</h2>
    @else
        {!! $page->page_body !!}
    @endif
</section>
@endsection

@push('scripts')

@endpush
