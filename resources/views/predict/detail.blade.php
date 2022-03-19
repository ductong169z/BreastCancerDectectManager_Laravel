@extends('layouts.admin')

@section('main-content')
<div class="bg-light p-4 rounded">
    <h2>Add new predict request</h2>
    <div class="lead">
        Add new predict request.
    </div>

    <div class="container mt-4">

        <form action="{{ route('predict.doctor.confirm') }}" method="POST">
            {{ csrf_field() }}
            <input hidden name="id" value="{{ $id }}">
            <div class="mb-3">
                <label for="patient" class="form-label">Patient</label>
                {!! Form::select('patient', $paitients, $predict->patient_id, ['class' =>
                'form-control','disabled'=>'disabled']) !!}

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
                {!! Form::select('sonographer', $sonographer, $predict->sonographer_id, ['class' =>
                'form-control','disabled'=>'disabled']) !!}

                @if($errors->has('sonographer'))
                    <span class="text-danger text-left">{{ $errors->first('sonographer') }}</span>
                @endif
            </div>
            @if($predict->status==2)
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

            @can('predict.doctor.confirm')

                <div class="mb-3">
                    <label for="image" class="form-label">Confirm result</label>
                    <div class="form-check">
                        <input class="form-check-input" @if($predict->doctor_confirmation=="normal") checked @endif
                        type="radio" name="name" value="normal" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Normal
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" @if($predict->doctor_confirmation=="benign") checked @endif
                        type="radio" name="name" value="benign" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Benign
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" @if($predict->doctor_confirmation=="malignant") checked @endif type="radio" name="name" value="malignant" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Malignant
                        </label>
                    </div>
                </div>
                @endif
                <button type="submit" class="btn btn-primary">Save</button>
            @endcan

        </form>
    </div>

</div>
<script>

</script>
@endsection
