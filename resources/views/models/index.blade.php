@extends('layouts.admin')

@section('main-content')


    <div class="bg-light p-4 rounded">
        <h1>Models</h1>
        <div class="lead">
            Manage your Models here.
            <a href="{{ route('models.create') }}" class="btn btn-primary btn-sm float-right">Add new model</a>
        </div>

        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" width="1%">#</th>
                <th scope="col">name</th>
                <th scope="col" width="10%">file_name</th>
                <th scope="col" width="10%">description</th>
                <th scope="col" width="1%" colspan="3"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($models as $model)
                <tr>
                    <th scope="row">{{ $model->id }}</th>
                    <td>{{ $model->name }}</td>
                    <td>{{ $model->file_name }}</td>
                    <td>{{ $model->description }}</td>

                    <td><a href="{{ route('models.show', $model->id) }}" class="btn btn-warning btn-sm">Show</a></td>
                    <td><a href="{{ route('models.edit', $model->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                    <td><a href="{{ route('models.delete', $model->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>

                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="d-flex">
{{--            {!! $models->render() !!}--}}
        </div>

    </div>
@endsection
