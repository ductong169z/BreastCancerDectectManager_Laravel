@extends('layouts.admin')

@section('main-content')
<div class="bg-light p-4 rounded">
    <h1>Reset Password</h1>
    <div class="lead">
Reset user's password here.
    </div>

    <div class="container mt-4">
        <form method="post" action="{{ route('profile.update_password', $user->id) }}">
            @method('patch')
            @csrf
            <div class="mb-3">
                <label for="current_password" class="form-label">Old Password</label>
                <input value="{{ old('password') }}" type="password" class="form-control" name="current_password" placeholder="password" required>
                @if ($errors->has('current_password'))
                <span class="text-danger text-left">{{ $errors->first('current_password') }}</span>
                @endif

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input value="{{ old('password') }}" type="password" class="form-control" name="password" placeholder="password" required>
                @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                @endif

            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm new password</label>
                <input value="{{ old('password') }}" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
                @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                @endif

            </div>

            <button type="submit" class="btn btn-primary">Reset password</button>
            <a href="{{ route('profile') }}" class="btn btn-default">Back</a>
        </form>
    </div>

</div>
@endsection
