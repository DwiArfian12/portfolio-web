@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card card-dashboard bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Profile</h6>
                        <h2 class="mt-2 mb-0">{{ $profileCount }}</h2>
                    </div>
                    <i class="fas fa-user fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card card-dashboard bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Skills</h6>
                        <h2 class="mt-2 mb-0">{{ $skillCount }}</h2>
                    </div>
                    <i class="fas fa-cogs fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card card-dashboard bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Gallery Items</h6>
                        <h2 class="mt-2 mb-0">{{ $galleryCount }}</h2>
                    </div>
                    <i class="fas fa-images fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card card-dashboard bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Projects</h6>
                        <h2 class="mt-2 mb-0">{{ $projectCount }}</h2>
                    </div>
                    <i class="fas fa-folder-open fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card card-dashboard bg-danger text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Total Messages</h6>
                        <h2 class="mt-2 mb-0">{{ $messageCount }}</h2>
                    </div>
                    <i class="fas fa-envelope fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card card-dashboard bg-secondary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Unread Messages</h6>
                        <h2 class="mt-2 mb-0">{{ $unreadMessages }}</h2>
                    </div>
                    <i class="fas fa-envelope-open fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.profiles.create') }}" class="btn btn-outline-primary w-100">
                            <i class="fas fa-user-plus me-2"></i>Add Profile
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.skills.create') }}" class="btn btn-outline-success w-100">
                            <i class="fas fa-plus-circle me-2"></i>Add Skill
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.galleries.create') }}" class="btn btn-outline-warning w-100">
                            <i class="fas fa-plus-circle me-2"></i>Add Gallery Image
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.projects.create') }}" class="btn btn-outline-info w-100">
                            <i class="fas fa-plus-circle me-2"></i>Add Project
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
