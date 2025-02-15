@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="mt-4">Edit Home Page</h1>
    <form action="{{ route('admin.home.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="content">Home Page Content</label>
            <textarea name="content" id="content" rows="6" class="form-control" required>{{ $homeContent }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
