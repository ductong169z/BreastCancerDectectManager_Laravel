@extends('layouts.admin')

@section('main-content')
    <div class="bg-light p-4 rounded">
        <h1>Reset password</h1>
        <div class="lead">

        </div>

        <div class="container mt-4">
            <form method="post" action="{{ route(' ', $user->id) }}">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ $user->name }}"
                           type="text"
                           class="form-control"
                           name="name"
                           placeholder="Name" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input value="{{ $user->email }}"
                           type="email"
                           class="form-control"
                           name="email"
                           placeholder="Email address" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <label class="form-control" readonly>{{ $user->username }}</label>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    {{ Form::select('status', [1 => 'Active', 0 => 'Deactive'], $user->status, array('class'=>'form-control')) }} 
                    @if ($errors->has('role'))
                        <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update user</button>
                <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</button>
                <a href="{{ route('users.index') }}" class="btn btn-default">Reset password</button>
            </form>
        </div>

    </div>
@endsection
