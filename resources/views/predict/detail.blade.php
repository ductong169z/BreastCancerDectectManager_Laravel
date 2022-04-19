@extends('layouts.admin')

@section('main-content')
    <link rel="stylesheet" href="{{url('css/fancybox.css')}}" />
    <div class="bg-light p-4 rounded">
        <h2>Prediction Request Detail </h2>
        <div class="lead">
            Prediction request detail.
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
                    <label for="patient" class="form-label">Patient Gender</label>
                    <label class="form-control">{{ $currentPatient->gender == 1 ? 'Male' : 'Female' }}</label>

                </div>
                <div class="mb-3">
                    <label for="patient" class="form-label">Patient ID Number</label>
                    <label  class="form-control disabled">{{ $currentPatient->id_number }}</label>

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
                                    <img src="{{ $predict->output_image }}" width="300" height="300">
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
                            @if ($key == 'benign')
                                <div class="col-xl-4 col-md-4 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
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
                            @if ($key == 'normal')
                                <div class="col-xl-4 col-md-4 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
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

                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('predict.index') }}" class="btn btn-default">Back</a>
                    @endcan
                @else
                    @can('predict.upload')
                        <a class="btn btn-primary btn-sm" href="javascript:void(0)" data-type="upload" data-id="' +
                                                    data.data_id + '" onclick="show_upload_modal(this)">Upload Image</a>
                        <a href="{{ route('predict.index') }}" class="btn btn-default">Back</a>
                    @endcan
                @endif
            </form>
        </div>
        <!-- Modal upload image-->
        <div class="modal fade" id="upload-modal" tabindex="-1" role="dialog" aria-labelledby="uploadImageTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Upload Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="upload-image" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input hidden id="id" name="id">
                            <input type="file" name="image" class="form-control">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" onclick="fetchUploadImage()" class="btn btn-primary">Sumbit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{url('js/fancybox.umd.js')}}"></script>
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

        function show_upload_modal(e) {
            $("#id").val(e.dataset.id)
            $("#upload-modal").modal();

        }

        function fetchUploadImage() {

            let myForm = document.getElementById('upload-image');
            let formData = new FormData(myForm);
            $("#upload-modal").modal('hide');
            $.ajax({
                url: "{{ route('predict.upload') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                // async: false,
                success: function(response) {
                    table.ajax.reload(null, false);
                }
            })

        }
    </script>

@endsection
