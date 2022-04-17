@extends('layouts.admin')

@section('main-content')
    <div class="bg-light p-4 rounded">
        <h1>Update model</h1>
        <div class="lead">

        </div>
        {{--        {{ route('model', $model->id) }}--}}
        <div class="container mt-4">
            <form method="post" action="{{route('models.update',$model->id)}}" enctype="multipart/form-data">

                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ $model->name }}"
                           type="text"
                           class="form-control"
                           name="name"
                           placeholder="Name" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="current file" class="form-label">Current Model File Name:</label>
                    <input value="{{ $model->file_name }}"
                           type="text"
                           class="form-control"
                           name="old_file_name"
                           disabled
                           placeholder="Name" required>

                    @if ($errors->has('old_file_name'))
                        <span class="text-danger text-left">{{ $errors->first('old_file_name') }}</span>
                    @endif

                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">New Model File:</label><br>
                    <input type="file"
                           name="new_file_name"
                           placeholder="Change other file" >
                    @if ($errors->has('new_file_name'))
                        <span class="text-danger text-left">{{ $errors->first('new_file_name') }}</span>
                    @endif
                    @if (session('alertMessageFail'))
                        <div class="alert alert-danger">
                            {{ session('alertMessageFail') }}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input value="{{ $model->description }}"
                           type="text"
                           class="form-control"
                           name="description"
                           placeholder="Description" required>
                    @if ($errors->has('description'))
                        <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                    @endif
                </div>


                <button type="submit" class="btn btn-primary">Update model</button>
                {{--                <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</button>--}}
            </form>
        </div>

    </div>
@endsection
