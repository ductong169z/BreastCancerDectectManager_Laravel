@extends('layouts.admin')

@section('main-content')
    <div class="bg-light p-4 rounded">
        <h1>Reset password</h1>
        <div class="lead">

        </div>

        <div class="container mt-4">
            <form method="post" action="{{ route('users.update', $user->id) }}">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Old password</label>
                    <input type="password"
                           class="form-control"
                           name="oldpass"
                           placeholder="Old password" required>
                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">New password</label>
                    <input type="password"
                           class="form-control"
                           name="newpass"
                           placeholder="New password" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Confirm password</label>
                    <input type="password"
                           class="form-control"
                           name="conpass"
                           placeholder="Old password" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Reset password</button>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-default">Cancel</button>
            </form>
        </div>

    </div>
@endsection
