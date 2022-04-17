@extends('layouts.admin')

@section('main-content')
    <div class="bg-light p-4 rounded">
        <h1>Add New Model</h1>
        <div class="lead">
            Add new model here.
        </div>
        <div class="container mt-4">
            <form method="POST" action="{{route('models.store')}}"  enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ old('name') }}"
                           type="text"
                           class="form-control"
                           name="name"
                           placeholder="Name" required>
                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3" style="padding-top: 1.5%">
                    <label for="file" class="form-label">File</label>
                    <input value="{{ old('file') }}"
                           type="file"
                           name="file_name"
                           placeholder="Choose your model file" required>
                    @if ($errors->has('file_name'))
                        <span class="text-danger text-left">{{ $errors->first('file_name') }}</span>
                    @endif
                    @if (session('alertMessageFail'))
                        <div class="alert alert-danger">
                            {{ session('alertMessageFail') }}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input value="{{ old('description') }}"
                           type="text"
                           class="form-control"
                           name="description"
                           placeholder="Description" required>
                    @if ($errors->has('description'))
                        <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Save model</button>
                <a href="{{ route('models.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>


@endsection

