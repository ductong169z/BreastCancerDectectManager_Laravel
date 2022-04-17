@extends('layouts.admin')

@section('main-content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />
<style type="text/css">
    .btn-group-sm>.btn,
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: .6rem;
        line-height: 1;
        border-radius: 0.6rem;
    }
</style>
<div class="bg-light p-4 rounded">
    <h2>Prediction</h2>
    <div class="lead mb-3">
        Manage your prediction here.
        @can("predict.create")
        <a href="{{ route('predict.create') }}" class="btn btn-primary float-right">Add new
            prediction
            request</a>
        @endcan
    </div>

    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

    <table class="table table-striped table-bordered" style="width:100%!important" id="predict-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Doctor name</th>
                <th>Sonographer name</th>
                <th>Patient name</th>
                <th>Doctor confirmation</th>
                <th>Upload status</th>
                <th>
                </th>
            </tr>
        </thead>
        <tbody>
        </tbody>

    </table>
    <!-- Modal upload image-->
    <div class="modal fade" id="upload-modal" tabindex="-1" role="dialog" aria-labelledby="uploadImageTitle" aria-hidden="true">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<script>
    let patientName=$("#patient").val()??''
    let table = $('#predict-table').DataTable({
        searching: true,
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
        "order": [[ 0, "desc" ]],
        "ajax": {
            "url": "{{ route('predict.api') }}",
            'data':{userId:'{{Auth::user()->id}}',patient:patientName},
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
                data: 'doctor_confirmation',
                name: 'doctor_confirmation'
            },
            {
                data: 'status',
                name: 'status',
                "render": function(data, type, row, meta) {
                    if (data == 0) {
                        return '<label>Not Yet</label>';
                    } else if (data == 1) {
                        return '<label style="color: #00bc8c;">In Progress</label>';
                    } else if (data == 2) {
                        return '<label style="color: #006bbc;">Completed</label>';
                    }
                }
            }, {
                data: function(row, type, val, meta) {
                    return {
                        'data_status': row.status,
                        'data_id': row.id
                    }
                },
                "searchable": false,
                "render": function(data, type, row, meta) {
                    if (data.data_status == 0) {
                        return '<ul class="list-inline d-flex justify-content-center">' +
                            '@can("predict.upload")' +
                            '<li class="list-inline-item"><a class="btn btn-primary btn-sm" href="javascript:void(0)" data-type="upload" data-id="' +
                            data.data_id + '" onclick="show_upload_modal(this)">Upload Image</a></li>' +
                            '@endcan' +
                            '@can("predict.show")' +
                            '<li class="list-inline-item"><a class="btn btn-info btn-sm" href="{{ route('predict.show','') }}/' +
                        data.data_id + '" data-type="view">View</a></li>' +
                            '@endcan' +
                            '@can("predict.edit")' +
                            '<li class="list-inline-item"><a class="btn btn-warning btn-sm" href="{{ route('predict.edit','') }}/' +
                        data.data_id + '" data-type="edit" data-id="' +
                            data.data_id + '" onclick="change_status(this)">Edit</a></li>' +
                            '@endcan' +
                            '@can("predict.delete")' +
                            '<li class="list-inline-item"><a class="btn btn-danger btn-sm" onclick="return confirm(\'Are you want delete it !\')" href="{{ route('predict.delete','') }}/' +
                        data.data_id + '" data-type="delete" data-id="' +
                            data.data_id + '" onclick="change_status(this)">Delete</a></li>' +
                            '@endcan' +
                            '</ul>'
                    } else {
                        return '<ul class="list-inline d-flex justify-content-center">' +
                            '@can("predict.show")' +
                            '<li class="list-inline-item"><a class="btn btn-warning btn-sm" href="{{ route('predict.show','') }}/' +
                        data.data_id + '" data-type="view">View</a></li>' +
                            '@endcan' +
                            '@can("predict.edit")' +
                            '<li class="list-inline-item"><a class="btn btn-info btn-sm" href="{{ route('predict.edit','') }}/' +
                        data.data_id + '" data-type="edit" data-id="' +
                            data.data_id + '" onclick="change_status(this)">Edit</a></li>' +
                            '@endcan' +
                            '@can("predict.delete")' +
                            '<li class="list-inline-item"><a class="btn btn-danger btn-sm" onclick="return confirm(\'Are you want delete it !\')" href="{{ route('predict.delete','') }}/' +
                        data.data_id + '" data-type="delete" data-id="' +
                            data.data_id + '" onclick="change_status(this)">Delete</a></li>' +
                            '@endcan' +
                            '</ul>'
                    }
                }
            }


        ]

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
            success: function (response) {
                table.ajax.reload(null, false);
            }
        })

    }

</script>
@endsection
