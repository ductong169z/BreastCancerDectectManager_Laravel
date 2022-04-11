@extends('layouts.admin')

@section('main-content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
    <div class="bg-light p-4 rounded">
        <h2>Detail predict request</h2>
        <div class="lead">
            Detail predict request.
        </div>

        <div class="container mt-4">

            <form action="{{ route('predict.doctor.confirm') }}" method="POST">
                {{ csrf_field() }}
                <input hidden name="id" value="{{ $id }}">
                <div class="mb-3">
                    <label for="patient" class="form-label">Patient</label>
                    {!! Form::select('patient', $paitients, $predict->patient_id, ['class' => 'form-control', 'disabled' => 'disabled']) !!}

                    @if ($errors->has('patient'))
                        <span class="text-danger text-left">{{ $errors->first('patient') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="patient" class="form-label">Doctor</label>
                    <label class="form-control">{{ \App\User::find($predict->doctor_id)->name }}</label>
                    @if ($errors->has('patient'))
                        <span class="text-danger text-left">{{ $errors->first('patient') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="sonographer" class="form-label">Sonographer</label>
                    {!! Form::select('sonographer', $sonographer, $predict->sonographer_id, ['class' => 'form-control', 'disabled' => 'disabled']) !!}

                    @if ($errors->has('sonographer'))
                        <span class="text-danger text-left">{{ $errors->first('sonographer') }}</span>
                    @endif
                </div>
                @if ($predict->status == 2)
                    <div class="row">

                        <div class="mb-3 col-md-6 text-center">
                            <label for="image" class="form-label">Input image</label>
                            <div class="">
                                <a data-fancybox="responsive" data-src="{{ $input_image }}"
                                    data-sizes="(max-width: 600px) 480px, 800px">
                                    <img src="{{ $input_image }}" width="300" height="300">
                                </a>

                            </div>
                        </div>
                        <div class="mb-3 col-md-6 text-center">
                            <label for="image" class="form-label">Output image</label>
                            <div class="">
                                <a data-fancybox="responsive" data-src="{{ $predict->output_image }}"
                                    data-sizes="(max-width: 600px) 480px, 800px">
                                    <img src="{{  }}" width="300" height="300">
                                </a>
                            </div>
                        </div>
                    </div>
                    <label for="image" class="form-label">Prediction result</label>

                    <div class="row mb-3">
                        @foreach (json_decode($predict->predict_result) as $key => $value)
                            @if ($key == 'malignant')
                                <div class="col-xl-4 col-md-4 mb-4">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                        {{ $key }}</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        {{ round($value, 2) }}%
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-percent fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($key=='benign')
                                <div class="col-xl-4 col-md-4 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div
                                                    class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    {{ $key }}</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ round($value, 2) }}%
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-percent fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($key=='normal')
                                <div class="col-xl-4 col-md-4 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div
                                                    class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    {{ $key }}</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ round($value, 2) }}%
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-percent fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach


                    </div>


                    @can('predict.doctor.confirm')
                        <div class="mb-3">
                            <label for="image" class="form-label">Confirm result</label>

                            <select id='confirm' name="name" class="form-control" required>
                                <option value="">-------Select type of cancer-------</option>
                                <option value="normal" @if ($predict->doctor_confirmation == 'normal') selected @endif>Normal</option>
                                <option value="benign" @if ($predict->doctor_confirmation == 'benign') selected @endif> Benign
                                </option>
                                <option value="malignant" @if ($predict->doctor_confirmation == 'malignant') selected @endif>Malignant</option>
                            </select>


                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Save</button>
                @endcan

            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script>
        Fancybox.bind("[data-fancybox]", {
            Image: {
                Panzoom: {
                    zoomFriction: 1,
                    maxScale: function() {
                        return 5;
                    },
                },
            },
        });
        $('#confirm`').on('change', function() {
            alert(this.value);
        });
    </script>
@endsection
