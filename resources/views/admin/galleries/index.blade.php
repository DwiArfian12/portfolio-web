@extends('admin.layouts.app')

@section('title', 'Gallery Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Gallery</h5>
        <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus me-1"></i>Add Image</a>
    </div>
    <div class="card-body">
        @if($galleries->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($galleries as $gallery)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('storage/'.$gallery->image_path) }}" width="60" height="60" style="object-fit:cover;border-radius:4px;"></td>
                        <td>{{ $gallery->title ?? '-' }}</td>
                        <td>
                            @php
                                $labels = ['gal_a' => 'Certificates', 'gal_b' => 'Achievements', 'gal_c' => 'Awards'];
                            @endphp
                            <span class="badge bg-info">{{ $labels[$gallery->category] ?? $gallery->category }}</span>
                        </td>
                        <td>{{ $gallery->order }}</td>
                        <td><span class="badge bg-{{ $gallery->is_active ? 'success' : 'danger' }}">{{ $gallery->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="d-inline">
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
        <p class="text-muted">No gallery images found.</p>
        @endif
    </div>
</div>
@endsection
