@extends('admin.layouts.app')

@section('title', 'Add Gallery Image')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Add Gallery Image</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Title (optional)</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Image <small>(jpeg, png, jpg, gif, webp - max 5MB)</small></label>
                <input type="file" name="image_path" class="form-control @error('image_path') is-invalid @enderror" required accept="image/*">
                @error('image_path')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                    <option value="gal_a" {{ old('category') == 'gal_a' ? 'selected' : '' }}>Certificates</option>
                    <option value="gal_b" {{ old('category') == 'gal_b' ? 'selected' : '' }}>Achievements</option>
                    <option value="gal_c" {{ old('category') == 'gal_c' ? 'selected' : '' }}>Awards</option>
                </select>
                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Category Label (optional)</label>
                    <input type="text" name="category_label" class="form-control @error('category_label') is-invalid @enderror" value="{{ old('category_label') }}">
                    @error('category_label')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Order</label>
                    <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', 0) }}" min="0">
                    @error('order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 mb-3">
                    <div class="form-check mt-4">
                        <input type="checkbox" name="is_active" class="form-check-input" value="1" checked id="isActive">
                        <label class="form-check-label" for="isActive">Active</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Save</button>
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
