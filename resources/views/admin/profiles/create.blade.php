@extends('admin.layouts.app')

@section('title', 'Create Profile')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Create Profile</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.profiles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', 'Dwi Arfian') }}">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Subtitle</label>
                <textarea name="subtitle" class="form-control @error('subtitle') is-invalid @enderror" rows="2">{{ old('subtitle') }}</textarea>
                @error('subtitle')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">About Text</label>
                <textarea name="about_text" class="form-control @error('about_text') is-invalid @enderror" rows="4">{{ old('about_text') }}</textarea>
                @error('about_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Skills Headline</label>
                <textarea name="skills_headline" class="form-control @error('skills_headline') is-invalid @enderror" rows="2">{{ old('skills_headline') }}</textarea>
                @error('skills_headline')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">CV File (PDF only, max 10MB)</label>
                <input type="file" name="cv_file" class="form-control @error('cv_file') is-invalid @enderror">
                @error('cv_file')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Instagram URL</label>
                    <input type="url" name="instagram" class="form-control @error('instagram') is-invalid @enderror" value="{{ old('instagram') }}">
                    @error('instagram')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Facebook URL</label>
                    <input type="url" name="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook') }}">
                    @error('facebook')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Twitter URL</label>
                    <input type="url" name="twitter" class="form-control @error('twitter') is-invalid @enderror" value="{{ old('twitter') }}">
                    @error('twitter')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">YouTube URL</label>
                    <input type="url" name="youtube" class="form-control @error('youtube') is-invalid @enderror" value="{{ old('youtube') }}">
                    @error('youtube')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">GitHub URL</label>
                    <input type="url" name="github" class="form-control @error('github') is-invalid @enderror" value="{{ old('github') }}">
                    @error('github')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" class="form-check-input" value="1" checked id="isActive">
                <label class="form-check-label" for="isActive">Active</label>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Save</button>
            <a href="{{ route('admin.profiles.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
