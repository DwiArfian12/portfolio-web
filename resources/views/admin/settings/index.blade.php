@extends('admin.layouts.app')

@section('title', 'Account Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center mb-4">
                <div class="rounded-circle bg-primary bg-gradient p-3 me-3 shadow-sm">
                    <i class="fas fa-cog fa-2x text-white"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold">Account Settings</h4>
                    <p class="text-muted mb-0">Manage your account credentials and personal information</p>
                </div>
            </div>
        </div>
    </div>

    @if(session('status') === 'profile-information-updated')
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i> Profile information updated successfully!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('status') === 'password-updated')
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i> Password updated successfully!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Update Profile Information --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-user-edit text-primary me-2"></i>Profile Information
                    </h5>
                    <p class="text-muted small mb-0">Update your name and email address</p>
                </div>
                <div class="card-body px-4 pb-4">
                    <form method="POST" action="{{ route('admin.settings.update-information') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            @if(Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! Auth::user()->hasVerifiedEmail())
                                <div class="mt-2">
                                    <p class="text-warning small mb-1">
                                        <i class="fas fa-exclamation-triangle me-1"></i>Your email address is unverified.
                                    </p>
                                    <button type="button" class="btn btn-sm btn-outline-warning" onclick="event.preventDefault(); document.getElementById('send-verification').submit();">
                                        Resend verification email
                                    </button>
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </form>

                    @if(Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! Auth::user()->hasVerifiedEmail())
                        <form id="send-verification" method="POST" action="{{ route('verification.send') }}" style="display: none;">
                            @csrf
                        </form>
                    @endif
                </div>
            </div>
        </div>

        {{-- Update Password --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-lock text-primary me-2"></i>Update Password
                    </h5>
                    <p class="text-muted small mb-0">Ensure your account is using a strong password</p>
                </div>
                <div class="card-body px-4 pb-4">
                    <form method="POST" action="{{ route('admin.settings.update-password') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label fw-semibold">Current Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">New Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirm New Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-check-double"></i></span>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-2"></i>Update Password
                        </button>
                    </form>
                </div>
            </div>

            {{-- Account Info Card --}}
            <div class="card border-0 shadow-sm rounded-4 mt-4">
                <div class="card-body px-4 py-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                            <i class="fas fa-shield-alt fa-2x text-info"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Account Security Tips</h6>
                            <ul class="text-muted small mb-0 ps-3">
                                <li>Use at least 8 characters with a mix of letters, numbers & symbols</li>
                                <li>Don't use the same password across multiple sites</li>
                                <li>Update your password regularly for better security</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
