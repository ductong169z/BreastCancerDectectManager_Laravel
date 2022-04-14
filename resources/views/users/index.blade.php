@extends('layouts.admin')

@section('main-content')


<div class="bg-light p-4 rounded">
    <h1>Users</h1>
    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>
    <div class="lead">
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Add new
            user</a>
    </div>

    

    
    <div class="mt-2 mb-2">
            <form action="{{ route('users.index') }}" id="form1">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" value="{{ $user }}" class="form-control" name="user"
                               placeholder="User name">

                    </div>
                    <div class="col-md-2">
                        <button type="submit" form="form1" class="btn btn-primary">Search</button>

                    </div>
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
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                        @foreach($user->roles as $userrole)
                        {{ $userrole->name }}
                        @endforeach
            </td>
            <td><a href="{{ route('users.show', $user->id) }}"
                    class="btn btn-warning btn-sm">Show</a></td>
            <td><a href="{{ route('users.edit', $user->id) }}"
                    class="btn btn-info btn-sm">Edit</a></td>
            {{-- <td>
                    {{ Form::select('status', [1 => 'Active', 0 => 'Deactive'], $user->status) }}
            </td> --}}
            <td>
                {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' =>
                'display:inline']) !!}
                @if($user->status == 1)
                    {!! Form::submit('Active', ['class' => 'btn btn-success btn-sm','onclick' => 'return confirm("Are you want
                    deactive user")']) !!}
                    {!! Form::close() !!}

                @else
                    {!! Form::submit('Deactive', ['class' => 'btn btn-secondary btn-sm','onclick' => 'return confirm("Are you
                    want active user")']) !!}
                    {!! Form::close() !!}

                @endif
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex">
        {!! $users->links() !!}
    </div>

</div>

@endsection
