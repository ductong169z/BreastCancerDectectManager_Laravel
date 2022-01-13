@extends('layouts.admin')

@section('main-content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />
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
    <table class="table table-striped table-bordered" id="predict-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Doctor name</th>
                <th>Sonographer name</th>
                <th>Patients name</th>
                <th>Predict result</th>
                <!-- <th></th> -->
            </tr>
        </thead>
        <tbody>
        </tbody>
        <!-- <tbody>
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
           
        </tbody> -->
    </table>

    <!-- {{ $predict->links() }} -->
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<script>
    $('#predict-table').DataTable({
        searching: false,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "deferRender": true,
        "pagingType": "full_numbers",
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "deferRender": true,
        "ajax": {
            "url": "{{ route('predict.api') }}",
            "type": "get"
        },
        "columns": [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'doctor_name',
                name: 'doctor_name'
            },
            {
                data: 'sonographer_name',
                name: 'sonographer_name'
            },
            {
                data: 'patient_name',
                name: 'patient_name'
            },
            {
                data:'predict_result',
                name:'predict_result'
            }

        ]

    });

</script>
@endsection
