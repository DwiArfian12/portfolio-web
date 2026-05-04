@extends('admin.layouts.app')

@section('title', 'Projects Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Projects</h5>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus me-1"></i>Add Project</a>
    </div>
    <div class="card-body">
        @if($projects->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Year</th>
                        <th>URL</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('storage/'.$project->image_path) }}" width="60" height="60" style="object-fit:cover;border-radius:4px;"></td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->year ?? '-' }}</td>
                        <td>
                            @if($project->url)
                            <a href="{{ $project->url }}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fas fa-external-link-alt"></i></a>
                            @else
                            -
                            @endif
                        </td>
                        <td>{{ $project->order }}</td>
                        <td><span class="badge bg-{{ $project->is_active ? 'success' : 'danger' }}">{{ $project->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="d-inline">
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
        <p class="text-muted">No projects found.</p>
        @endif
    </div>
</div>
@endsection
