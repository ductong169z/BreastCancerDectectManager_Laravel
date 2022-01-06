@extends('layouts.admin')

@section('main-content')
    <div class="bg-light p-4 rounded">
        <h1>Show model</h1>
        <div class="lead">

        </div>

        <div class="container mt-4">
            <div>
                Name: {{ $model->name }}
            </div>
            <div>
                File Name: {{ $model->file_name }}
            </div>
            <div>
                Description: {{ $model->description }}
            </div>
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('models.edit', $model->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('models.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection
