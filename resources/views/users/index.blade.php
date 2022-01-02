@extends('layouts.admin')

@section('main-content')


    <div class="bg-light p-4 rounded">
        <h1>Users</h1>
        <div class="lead">
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Add new user</a>
        </div>

        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <div class="col-md-4">
            <form action="{{ route('users.search') }}" method="GET">
                <div class="form-group">
                    <input type="search" name="search" class="form-control">
                    <span class="form-control-btn">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </span>
                </div>
            </form>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" width="1%">#</th>
                    <th scope="col" width="15%">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col" width="10%">Username</th>
                    <th scope="col" width="10%">Roles</th>
                    <th scope="col" width="1%" colspan="3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            @foreach ($user->roles as $userrole)
                                <select class="badge bg-primary" name="role" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" @if ($role->name == $userrole->name)
                                            selected
                                    @endif
                                    >{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            @endforeach
                        </td>
                        <td><a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm">Show</a></td>
                        <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                        <td>
                            {{ Form::select('status', [1 => 'Active', 0 => 'Deactive'], $user->status) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('users.savechange', $user) }}" class="btn btn-primary">Save</a>
        <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</button>
        <div class="d-flex">
            {!! $users->links() !!}
        </div>
        
    </div>
@endsection
