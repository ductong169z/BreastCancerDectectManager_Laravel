@extends('layouts.admin')

@section('main-content')
    <div class="bg-light p-4 rounded">
        <h1>Update user</h1>
        <div class="lead">
            <div class="mt-2">
                @include('layouts.partials.messages')
            </div>
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
                    <label class="form-control" readonly>{{ $user->email }}</label>
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

                </div>

                <button type="submit" class="btn btn-primary">Update user</button>
                <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
                <a class="btn btn-dark float-right" href="{{ route('users.admin_reset_password', $user->id) }}" >Reset password</a>


            </form>
        </div>

    </div>
@endsection


