@extends('admin.layouts.app')

@section('title', 'Edit Project')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Edit Project</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $project->title) }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Year</label>
                    <input type="text" name="year" class="form-control @error('year') is-invalid @enderror" value="{{ old('year', $project->year) }}" placeholder="e.g. 2024">
                    @error('year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description', $project->description) }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Image <small>(leave empty to keep current)</small></label>
                <input type="file" name="image_path" class="form-control @error('image_path') is-invalid @enderror" accept="image/*">
                @if($project->image_path)
                <div class="mt-2">
                    <img src="{{ asset('storage/'.$project->image_path) }}" width="100" style="border-radius:4px;">
                </div>
                @endif
                @error('image_path')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Project URL</label>
                <input type="url" name="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url', $project->url) }}" placeholder="https://example.com">
                @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Order</label>
                    <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $project->order) }}" min="0">
                    @error('order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-check mt-4">
                        <input type="checkbox" name="is_active" class="form-check-input" value="1" id="isActive" {{ $project->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="isActive">Active</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Update</button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
