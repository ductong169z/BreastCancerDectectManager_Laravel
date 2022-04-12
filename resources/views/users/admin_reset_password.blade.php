@extends('layouts.admin')

@section('main-content')
<div class="bg-light p-4 rounded">
        <h1>Update user</h1>
        <div class="lead">

        </div>

        <div class="container mt-4">
            <form method="post" action="{{ route('users.update', $user->id) }}">
                @method('patch')
                @csrf
               

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input value="{{ $user->password }}"
                           type="password"
                           class="form-control"
                           name="password"
                           placeholder="New password" required>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input 
                           type="password"
                           class="form-control"
                           name="ConfirmPassword"
                           placeholder="Confirm password" required>
                </div>
              
                <button type="submit" class="btn btn-primary">Reset password</button>
                <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</button>
            </form>
        </div>

    </div>
@endsection
