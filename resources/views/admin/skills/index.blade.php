@extends('admin.layouts.app')

@section('title', 'Skills Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Skills</h5>
        <a href="{{ route('admin.skills.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus me-1"></i>Add Skill</a>
    </div>
    <div class="card-body">
        @if($skills->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Icon</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($skills as $skill)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $skill->title }}</td>
                        <td>{{ Str::limit($skill->description, 50) }}</td>
                        <td><i class="{{ $skill->icon_class }}"></i> <code>{{ $skill->icon_class }}</code></td>
                        <td>{{ $skill->order }}</td>
                        <td><span class="badge bg-{{ $skill->is_active ? 'success' : 'danger' }}">{{ $skill->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="d-inline">
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
        <p class="text-muted">No skills found. Click "Add Skill" to create one.</p>
        @endif
    </div>
</div>
@endsection
