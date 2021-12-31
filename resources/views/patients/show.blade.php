@extends('layouts.admin')

@section('main-content')
    <div class="bg-light p-4 rounded">
        <h1>Show patient</h1>
        <div class="lead">

        </div>

        <div class="container mt-4">
            <div>
                Name: {{ $patient->name }}
            </div>
            @if($patient->gender =='1')
                <div>Gender: Male</div>
            @else
                <div>Gender: Female</div>
            @endif
            <div>
                ID Number: {{ $patient->id_number }}
            </div>
            <div>
                Address: {{ $patient->address }}
            </div>
            <div>
                Phone Number: {{ $patient->phone }}
            </div>
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('patients.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection
