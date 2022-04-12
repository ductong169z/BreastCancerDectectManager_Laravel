@extends('layouts.admin')

@section('main-content')

<div class="bg-light p-4 rounded">
    <h1 class="text-bold">Show patient</h1>
    <div class="container mt-4">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <label class="form-control">{{ $patient->name }}</label>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <label class="form-control">
                @if($patient->gender =='1')
                Male
                @else
                Female
                @endif
            </label>

        </div>
        <div class="mb-3">
            <label for="id_number" class="form-label">ID number</label>
            <label class="form-control">{{ $patient->id_number }}</label>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <label class="form-control">{{ $patient->address }}</label>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <label class="form-control">{{ $patient->phone }}</label>
        </div>

        <div class="mt-4">
            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-info">Edit</a>
            <a href="{{ route('patients.index') }}" class="btn btn-default">Back</a>
        </div>
    </div>
</div>


@endsection