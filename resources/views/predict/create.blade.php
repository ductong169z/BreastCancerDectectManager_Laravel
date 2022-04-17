@extends('layouts.admin')
@section('main-content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="bg-light p-4 rounded">
        <h2>Add New Prediction Request</h2>
        <div class="lead">
            Add new prediction request.
        </div>

        <div class="container mt-4">

            <form enctype='multipart/form-data' method="POST" action="{{ route('predict.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="patient" class="form-label">Patient</label>
                    {!! Form::select('patient', $paitients, null, ['class' => 'form-control js-example-basic-single', 'required']) !!}

                    @if ($errors->has('patient'))
                        <span class="text-danger text-left">{{ $errors->first('patient') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="sonographer" class="form-label">Sonographer</label>
                    {!! Form::select('sonographer', $sonographer, null, ['class' => 'form-control', 'required']) !!}

                    @if ($errors->has('sonographer'))
                        <span class="text-danger text-left">{{ $errors->first('sonographer') }}</span>
                    @endif
                </div>
                @if (Auth::user()->hasRole('sonographer'))
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image" required>
                        @if ($errors->has('image'))
                            <span class="text-danger text-left">{{ $errors->first('image') }}</span>
                        @endif
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">Save prediction</button>
                <a href="{{ route('predict.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>

@endsection
@section('add-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
