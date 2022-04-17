@extends('layouts.admin')

@section('main-content')
    <div class="bg-light p-4 rounded">
        <h2>Permissions</h2>
        <div class="lead">
            Manage your permissions here.
            <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm float-right">Add new permissions</a>
        </div>

        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>
        <div class="mt-2 mb-2">
            <form action="{{ route('permissions.index') }}">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control form-control-sm" value="{{ $name }}" id="permissions"
                            name="permissions" placeholder="Permission name">

                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success">Search</button>

                    </div>
                </div>
            </form>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" width="15%">Name</th>
                    <th scope="col">Guard</th>
                    <th scope="col" colspan="3" width="1%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->guard_name }}</td>
                        <td><a href="{{ route('permissions.edit', $permission->id) }}"
                                class="btn btn-info btn-sm">Edit</a>
                        </td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id], 'style' => 'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
    <div class="col-md-9"></div>
    <div class="col-md-3">{{ $permissions->appends(request()->query())->links() }}</div>
@endsection
