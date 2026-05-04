@extends('admin.layouts.app')

@section('title', 'Messages')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Contact Messages</h5>
    </div>
    <div class="card-body">
        @if($messages->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $message)
                    <tr class="{{ !$message->is_read ? 'table-primary' : '' }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->phone ?? '-' }}</td>
                        <td>{{ Str::limit($message->message, 50) }}</td>
                        <td>{{ $message->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <span class="badge bg-{{ $message->is_read ? 'secondary' : 'success' }}">
                                {{ $message->is_read ? 'Read' : 'New' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-muted">No messages yet.</p>
        @endif
    </div>
</div>
@endsection
