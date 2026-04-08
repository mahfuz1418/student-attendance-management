@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width: 520px;">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <h5 class="mb-4 fw-500">Edit User</h5>

            @if ($errors->any())
                <div class="alert alert-danger py-2">
                    @foreach ($errors->all() as $error)
                        <div style="font-size: 13px;">• {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="/users/{{ $user->id }}/update">
                @csrf

                <div class="mb-3">
                    <label class="form-label text-secondary" style="font-size: 13px;">Full name</label>
                    <input name="name" value="{{ old('name', $user->name) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label text-secondary" style="font-size: 13px;">Email address</label>
                    <input name="email" value="{{ old('email', $user->email) }}" class="form-control">
                </div>

                <div class="mb-4">
                    <label class="form-label text-secondary" style="font-size: 13px;">Role</label>
                    <select name="role" class="form-select">
                        <option value="student" {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>Student</option>
                        <option value="teacher" {{ old('role', $user->role) == 'teacher' ? 'selected' : '' }}>Teacher</option>
                        <option value="admin"   {{ old('role', $user->role) == 'admin'   ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill">Update user</button>
                    <a href="/users" class="btn btn-outline-secondary flex-fill">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
