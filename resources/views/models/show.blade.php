
@extends('layouts.admin')

@section('main-content')
<div class="bg-light p-4 rounded">
    <h1 class="text-bold">Show model</h1>
    <div class="container mt-4">
        <div class="mb-3">
            <label for="model name" class="form-label">Name</label>
            <label class="form-control">{{ $model->name }}</label>
        </div>
        <div class="mb-3">
            <label for="file name" class="form-label">File Name:</label>
            <label class="form-control">{{ $model->file_name }}</label>
            
        </div>
        <div class="mb-3">
            <label for="Description" class="form-label">Description</label>
            <label class="form-control">{{ $model->description }}</label>
        </div>
        <div class="mt-4">
        <a href="{{ route('models.edit', $model->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('models.index') }}" class="btn btn-default">Back</a>
    </div>
    </div>
</div>
    
@endsection
