@extends('layouts.admin')

@section('main-content')


    <div class="bg-light p-4 rounded">
        <h1>patients</h1>

        <div class="mt-2 mb-2">
            <form action="{{ route('patients.index') }}" id="form1">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" value="{{ $patient }}" class="form-control" name="user name"
                               placeholder="User name">

                    </div>
                    <div class="col-md-2">
                        <button type="submit" form="form1" class="btn btn-success">Search</button>

                    </div>
                </div>
            </form>
        </div>

        <div class="lead">
            Manage your patients here.
            <a href="{{ route('patients.create') }}" class="btn btn-primary btn-sm float-right">Add new user</a>
        </div>

        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" width="1%">#</th>
                <th scope="col" width="15%">Name</th>
                <th scope="col" width="15%">Gender</th>
                <th scope="col" >Address</th>
                <th scope="col" width="10%">Phone number</th>
                <th scope="col" width="1%" colspan="3"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($patients as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    @if($user->gender =='1')
                        <td>Male</td>
                    @else
                        <td>Female</td>
                    @endif
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->phone }}</td>
                    <td><a href="{{ route('patients.show', $user->id) }}" class="btn btn-warning btn-sm">Show</a></td>
                    <td><a href="{{ route('patients.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                    <td>
                        {!! Form::open(['method' => 'DELETE','route' => ['patients.destroy', $user->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="d-flex">
            {!! $patients->links() !!}
        </div>

    </div>
@endsection
