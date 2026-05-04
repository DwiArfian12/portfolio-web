@extends('admin.layouts.app')

@section('title', 'Create Skill')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Create Skill</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.skills.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Icon Class <small>(e.g. flaticon-seo, flaticon-development, flaticon-idea, etc.)</small></label>
                <input type="text" name="icon_class" class="form-control @error('icon_class') is-invalid @enderror" value="{{ old('icon_class', 'flaticon-seo') }}" required>
                @error('icon_class')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Order</label>
                    <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', 0) }}" min="0">
                    @error('order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-check mt-4">
                        <input type="checkbox" name="is_active" class="form-check-input" value="1" checked id="isActive">
                        <label class="form-check-label" for="isActive">Active</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Save</button>
            <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
