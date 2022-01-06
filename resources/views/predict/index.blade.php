@extends('layouts.admin')

@section('main-content')


    <div class="bg-light p-4 rounded">
        <h2>Prediction</h2>
        <div class="lead">
            Manage your prediction here.
            <a href="{{ route('predict.create') }}" class="btn btn-primary btn-sm float-right">Add predict request</a>
        </div>

        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>
        <div class="mt-2">
            
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" width="15%">ID</th>

                <th scope="col" width="15%">Doctor name</th>
                <th scope="col" width="15%">Sonographer name</th>
                <th scope="col" width="15%">Paitients name</th>
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
                    <td>{{$item->patient_name}}</td>
                    <td>{{$item->doctor_confirmation}}</td>
                    <td>
                    <a href="{{ route('predict.edit', $item->id) }}" class="btn btn-info btn-sm">Detail</a>    
                    <a href="{{ route('predict.edit', $item->id) }}" class="btn btn-info btn-sm">Edit</a>
                    <a href="{{ route('predict.delete', $item->id) }}" onclick="return confirm('Are you sure you want to delete this')" class="btn btn-warning btn-sm">Delete</a>
                </td>

                    {{--                    <td>--}}
                    {{--                        --}}
                    {{--                        {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}--}}
                    {{--                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}--}}
                    {{--                        {!! Form::close() !!}--}}
                    {{--                    </td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
