@extends('layouts.app')

@section('content')
<h3>User List</h3>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Row: Add User left, Filter center -->
<div class="d-flex justify-content-between align-items-center mb-2">
    <!-- Add User button on left -->
    <div>
        <a href="/users/create" class="btn btn-primary">Add User</a>
    </div>

    <!-- Filter dropdown in center -->
    <div>
        <form method="GET" action="{{ url('/users') }}" class="d-flex">
            <select name="role" class="form-select me-2">
                <option value="">All Roles</option>
                <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Student</option>
                <option value="teacher" {{ request('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            <button type="submit" class="btn btn-secondary">Filter</button>
        </form>
    </div>
</div>

<table class="table">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
    </tr>

    @foreach($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role }}</td>
        <td>
            <a href="/users/{{ $user->id }}/edit">Edit</a> |
            <a href="/users/{{ $user->id }}/delete">Delete</a>
        </td>
    </tr>
    @endforeach
</table>
<div class="d-flex justify-content-end">
    {{ $users->links('pagination::bootstrap-5') }}
</div>
@endsection
