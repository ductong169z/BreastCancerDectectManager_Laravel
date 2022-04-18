@extends('layouts.admin')

@section('main-content')
    <div class="bg-light p-4 rounded">
        <h1>Roles</h1>
        <div class="lead">
            Manage your roles here.
            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm float-right">Add new role</a>
        </div>

        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>
        <div class="mt-2 mb-2">
            <form action="{{ route('roles.index') }}">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control form-control-sm" value="{{ $name }}" id="name"
                            name="name" placeholder="Role name">

                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Search</button>

                    </div>
                </div>
            </form>
        </div>
        <table class="table table-bordered">
            <tr>
                <th width="1%">No</th>
                <th>Name</th>
                <th width="3%" colspan="3">Action</th>
            </tr>
            @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="{{ route('roles.show', $role->id) }}">View</a>
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm','onclick' => 'return confirm("Do you want to delete this role?")'        ]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </table>

        <div class="d-flex">
            {!! $roles->appends(request()->query())->links() !!}
        </div>

    </div>
@endsection
