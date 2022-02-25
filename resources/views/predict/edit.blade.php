@extends('layouts.admin')

@section('main-content')
<div class="bg-light p-4 rounded">
    <h2>Add new predict request</h2>
    <div class="lead">
        Add new predict request.
    </div>

    <div class="container mt-4">

        <form enctype='multipart/form-data' method="POST" action="{{ route('predict.update') }}">
            @csrf
            <input hidden name="id" value="{{ $id }}">
            <div class="mb-3">
                <label for="patient" class="form-label">Patient</label>
                {!! Form::select('patient', $paitients, $predict->patient_id, ['class' => 'form-control']) !!}

                @if($errors->has('patient'))
                    <span class="text-danger text-left">{{ $errors->first('patient') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="patient" class="form-label">Doctor</label>
                <label class="form-control">{{ \App\User::find($predict->doctor_id)->name }}</label>
                @if($errors->has('patient'))
                    <span class="text-danger text-left">{{ $errors->first('patient') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="sonographer" class="form-label">Sonographer</label>
                {!! Form::select('sonographer', $sonographer, $predict->sonographer_id, ['class' => 'form-control']) !!}

                @if($errors->has('sonographer'))
                    <span class="text-danger text-left">{{ $errors->first('sonographer') }}</span>
                @endif
            </div>
            @if(!Auth::user()->hasRole('sonographer'))
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" id="image" required>
                    @if($errors->has('image'))
                        <span class="text-danger text-left">{{ $errors->first('image') }}</span>
                    @endif
                </div>
            @endif

            @if($predict->accuracy)
                <div class="mb-3">
                    <label for="image" class="form-label">Input image</label>
                    <div class="card">
                        <img src="{{ $input_image }}" class="img-fluid" width="300" height="300">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Output image</label>
                    <div class="card">
                        <img src="{{ $predict->output_image }}" class="img-fluid" width="300" height="300">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Predict result</label>
                    <label class="form-control">{{ $predict->predict_result }}</label>

                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Accuracy</label>
                    <label class="form-control">{{ $predict->accuracy }}</label>
                </div>
            @endif

            @if($predict->sonographer_result)
                <div class="mb-3">
                    <label for="image" class="form-label">Sonographer result</label>
                    <label class="form-control">{{ $predict->sonographer_result }}</label>
                </div>
            @endif
            @if($predict->doctor_confirmation)
                <div class="mb-3">
                    <label for="image" class="form-label">Doctor confirmation</label>
                    <label class="form-control">{{ $predict->doctor_confirmation }}</label>
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('predict.index') }}" class="btn btn-default">Back</a>
        </form>
    </div>

</div>
<script>
    
</script>
@endsection
