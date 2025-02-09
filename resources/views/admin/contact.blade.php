@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="mt-4">Contact Messages</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Received At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($message->message, 50) }}</td>
                    <td>{{ $message->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.messages.show', $message->id) }}" class="btn btn-info btn-sm">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection