@extends('admin.layouts.app')

@section('title', 'View Message')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Message from {{ $contactMessage->name }}</h5>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i>Back</a>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <strong>Name:</strong> {{ $contactMessage->name }}
        </div>
        <div class="mb-3">
            <strong>Email:</strong> <a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a>
        </div>
        <div class="mb-3">
            <strong>Phone:</strong> {{ $contactMessage->phone ?? '-' }}
        </div>
        <div class="mb-3">
            <strong>Received:</strong> {{ $contactMessage->created_at->format('d F Y H:i:s') }}
        </div>
        <div class="mb-3">
            <strong>Status:</strong>
            <span class="badge bg-{{ $contactMessage->is_read ? 'secondary' : 'success' }}">
                {{ $contactMessage->is_read ? 'Already Read' : 'New Message' }}
            </span>
        </div>
        <hr>
        <div class="mb-3">
            <strong>Message:</strong>
            <p class="mt-2 p-3 bg-light rounded">{{ $contactMessage->message }}</p>
        </div>
        <form action="{{ route('admin.messages.destroy', $contactMessage) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this message?')">
                <i class="fas fa-trash me-1"></i>Delete Message
            </button>
        </form>
    </div>
</div>
@endsection
