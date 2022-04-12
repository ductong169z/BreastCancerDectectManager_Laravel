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
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control"
                            name="role" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ in_array($role->name, $userRole)
                                    ? 'selected'
                                    : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    {{ Form::select('status', [1 => 'Active', 0 => 'Deactive'], $user->status, array('class'=>'form-control')) }} 
                    {{-- <select name="status" required >
                        <option @if ($user->status == 1)
                            value = {{$user->status}} selected
                        @endif  value= 1 > Activate</option>
                        <option @if ($user->status == 0)
                            value = {{$user->status}} selected
                        @endif  value= 0 > Deactive</option>
                    </select> --}}
                    
                <!-- <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
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
                </div> -->
                        
                </div>

                <button type="submit" class="btn btn-primary">Update user</button>
                <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</button>
                <a href="{{ route('users.admin_reset_password', $user->id) }}" class="btn btn-default">Reset password</button>
            </form>
        </div>

    </div>
@endsection
