@extends('layouts.admin')

@section('main-content')


    <div class="bg-light p-4 rounded">
        <h1>Models</h1>
        <div class="lead">
            Manage your models here.
            <a href="{{ route('models.create') }}" class="btn btn-primary btn-sm float-right">Add new model</a>
        </div>

        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" width="1%">Selected</th>
                <th scope="col" width="1%">#</th>
                <th scope="col">Name</th>
                <th scope="col" width="10%">File_name</th>
                <th scope="col" width="10%">Description</th>
                <th scope="col" width="1%" colspan="3"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($models as $model)
                <tr>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"  >
                    <td><input type="radio" name="rdoModel"  value="{{$model->id}}" {{ ($model->isSelected==1)? "checked" : "" }} ></td>
                    <th scope="row">{{ $model->id }}</th>
                    <td>{{ $model->name }}</td>
                    <td>{{ $model->file_name }}</td>
                    <td>{{ $model->description }}</td>

                    <td><a href="{{ route('models.show', $model->id) }}" class="btn btn-warning btn-sm">View</a></td>
                    <td><a href="{{ route('models.edit', $model->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                    <td><a href="{{ route('models.delete', $model->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>

                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="d-flex">
{{--            {!! $models->render() !!}--}}
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>

            $('input[type="radio"]').click(function(){
                var rdoModel = $(this).val();
                $.ajax({
                    url:"{{ route('models.updateSelected')}}",
                    method:"POST",
                    data:{
                        '_token': $('input[name=_token]').val(),
                        'id':rdoModel
                    },
                    success:function(data){

                    }
                });
            });
    </script>

@endsection
