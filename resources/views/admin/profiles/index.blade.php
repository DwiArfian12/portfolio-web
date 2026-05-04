@extends('admin.layouts.app')

@section('title', 'Profile Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Profile</h5>
        @if(!$profile)
        <a href="{{ route('admin.profiles.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Create Profile
        </a>
        @endif
    </div>
    <div class="card-body">
        @if($profile)
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 200px;">Name</th>
                    <td>{{ $profile->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Title</th>
                    <td>{{ $profile->title ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Subtitle</th>
                    <td>{{ $profile->subtitle ?? '-' }}</td>
                </tr>
                <tr>
                    <th>About Text</th>
                    <td>{{ $profile->about_text ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Skills Headline</th>
                    <td>{{ $profile->skills_headline ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $profile->email ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $profile->phone ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Social Links</th>
                    <td>
                        @if($profile->instagram)<a href="{{ $profile->instagram }}" target="_blank" class="me-2"><i class="fab fa-instagram"></i></a>@endif
                        @if($profile->facebook)<a href="{{ $profile->facebook }}" target="_blank" class="me-2"><i class="fab fa-facebook"></i></a>@endif
                        @if($profile->twitter)<a href="{{ $profile->twitter }}" target="_blank" class="me-2"><i class="fab fa-twitter"></i></a>@endif
                        @if($profile->youtube)<a href="{{ $profile->youtube }}" target="_blank" class="me-2"><i class="fab fa-youtube"></i></a>@endif
                        @if($profile->github)<a href="{{ $profile->github }}" target="_blank" class="me-2"><i class="fab fa-github"></i></a>@endif
                    </td>
                </tr>
                <tr>
                    <th>CV File</th>
                    <td>
                        @if($profile->cv_file)
                            <a href="{{ asset('storage/'.$profile->cv_file) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-download me-1"></i>Download CV
                            </a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge bg-{{ $profile->is_active ? 'success' : 'danger' }}">
                            {{ $profile->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Actions</th>
                    <td>
                        <a href="{{ route('admin.profiles.edit', $profile) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form action="{{ route('admin.profiles.destroy', $profile) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
        @else
        <p class="text-muted">No profile created yet. Click "Create Profile" to add one.</p>
        @endif
    </div>
</div>
@endsection
