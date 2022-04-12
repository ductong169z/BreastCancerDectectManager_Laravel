@extends('layouts.admin')

@section('main-content')
<div class="bg-light p-4 rounded">
    <h1 class="text-bold">Show user</h1>
    <div class="container mt-4">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <label class="form-control">{{ $user->name }}</label>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <label class="form-control">{{ $user->email }}</label>
            
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <label class="form-control">{{ $user->username }}</label>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <label class="form-control">
            @foreach($user->roles as $userrole)
                {{$userrole->name}}
            @endforeach</label>
        </div>
        <div class="mt-4">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a>
            <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
        </div>
    </div>
</div>

@endsection