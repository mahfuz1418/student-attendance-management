@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width: 520px;">
    <div class="card ">
        <div class="card-body p-4">

            <h5 class="mb-4">Create User</h5>

            @if ($errors->any())
                <div class="alert alert-danger py-2">
                    @foreach ($errors->all() as $error)
                        <div style="font-size: 13px;">• {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="/users">
                @csrf

                <div class="mb-3">
                    <label class="form-label text-secondary" style="font-size: 13px;">Full name</label>
                    <input name="name" placeholder="John Doe" value="{{ old('name') }}" class="form-control">
                    @error('name') <div class="text-danger" style="font-size: 12px;">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label text-secondary" style="font-size: 13px;">Email address</label>
                    <input name="email" placeholder="you@example.com" value="{{ old('email') }}" class="form-control">
                    @error('email') <div class="text-danger" style="font-size: 12px;">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label text-secondary" style="font-size: 13px;">Password</label>
                    <input name="password" type="password" placeholder="••••••••" class="form-control">
                    @error('password') <div class="text-danger" style="font-size: 12px;">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-secondary" style="font-size: 13px;">Role</label>
                    <select name="role" class="form-select">
                        <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                        <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                        <option value="admin"   {{ old('role') == 'admin'   ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill">Create user</button>
                    <a href="/users" class="btn btn-outline-secondary flex-fill">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

