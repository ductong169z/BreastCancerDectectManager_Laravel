@extends('layouts.admin')

@section('main-content')


<div class="bg-light p-4 rounded">
    <h2>Prediction</h2>
    <div class="lead">
        Manage your prediction here.
        @can("predict.create")
            <a href="{{ route('predict.create') }}" class="btn btn-primary btn-sm float-right">Add
                predict
                request</a>
        @endcan
    </div>

    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>
    <div class="mt-2 mb-2">
        <form action="{{ route('predict.index') }}">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" value="{{ $patient }}" name="patient"
                        placeholder="Patient name">

                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success">Search</button>

                </div>
            </div>
        </form>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" width="15%">ID</th>

                <th scope="col" width="15%">Doctor name</th>
                <th scope="col" width="15%">Sonographer name</th>
                <th scope="col" width="15%">Patients name</th>
                <th scope="col" width="15%">Doctor confirmation</th>
                <th scope="col" colspan="3" width="20%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($predict as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->doctor_name }}</td>
                    <td>{{ $item->sonographer_name }}</td>
                    <td>{{ $item->patient_name }}</td>
                    <td>{{ $item->doctor_confirmation }}</td>
                    <td>
                        <a href="{{ route('predict.edit', $item->id) }}"
                            class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('predict.edit', $item->id) }}"
                            class="btn btn-info btn-sm">Edit</a>
                        <a href="{{ route('predict.delete', $item->id) }}"
                            onclick="return confirm('Are you sure you want to delete this')"
                            class="btn btn-warning btn-sm">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


</div>

@endsection
