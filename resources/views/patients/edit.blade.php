@extends('layouts.admin')

@section('main-content')
    <div class="bg-light p-4 rounded">
        <h1>Edit Patient</h1>
        <div class="lead">
Edit patient here.
        </div>

        <div class="container mt-4">
            <form method="post" action="{{ route('patients.update', $patient->id) }}">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ $patient->name }}"
                           type="text"
                           class="form-control"
                           name="name"
                           placeholder="Name" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" value="{{ old('gender') }}" class="form-control">
                        @if($patient->gender =='1')
                            <option value="0">Female</option>
                            <option value="1" selected>Male</option>
                        @else
                            <option value="0" selected>Female</option>
                            <option value="1">Male</option>
                        @endif
                    </select>
                    @if ($errors->has('gender'))
                        <span class="text-danger text-left">{{ $errors->first('gender') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="id_number" class="form-label">ID Number</label>
                    <input value="{{ $patient->id_number }}"
                           type="number"
                           class="form-control"
                           name="id_number"
                           placeholder="ID Number" required>
                    @if ($errors->has('id_number'))
                        <span class="text-danger text-left">{{ $errors->first('id_number') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input value="{{ $patient->phone }}"
                           type="number"
                           class="form-control"
                           name="phone"
                           placeholder="Phone Number" required>
                    @if ($errors->has('phone'))
                        <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input value="{{ $patient->address }}"
                           type="text"
                           class="form-control"
                           name="address"
                           placeholder="Address" required>

                    @if ($errors->has('address'))
                        <span class="text-danger text-left">{{ $errors->first('address') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update patient</button>
                <a href="{{ route('patients.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>
@endsection
