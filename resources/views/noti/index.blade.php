@extends('layouts.admin')

@section('main-content')


<div class="bg-light p-4 rounded">
    <h1>Notifications</h1>
    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>
    <div class="lead">
    </div>

    <div class="mt-2 mb-2">
        <form action="{{ route('notification.index') }}" id="form1">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" value="{{ $search }}" class="form-control" name="search" placeholder="Title">

                </div>
                <div class="col-md-2">
                    <button type="submit" form="form1" class="btn btn-primary">Search</button>

                </div>
            </div>
        </form>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" width="15%">Title</th>
                <th scope="col">Body</th>
                <th scope="col" width="10%">Date</th>
                <th scope="col" width="1%">Status</th>
                <th scope="col" width="10%" colspan="10"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($notications as $noti)
            <tr>
                <td class="align-middle">{{ $noti->title }}</td>
                <td class="align-middle">{{ $noti->body }}</td>
                <td class="align-middle">{{ $noti->created_at }}</td>
                <td class="text-center align-middle">
                    @if($noti->status) 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="lightgreen" class="bi bi-circle-fill" viewBox="0 0 16 16"><circle cx="8" cy="8" r="8"/></svg>
                    @endif
                    </td>             
                <td><a href="{{ route('notification.update',$noti->id) }}" class="btn btn-warning btn-sm">Link to Predict</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex">
        {!! $notications->links() !!}
    </div>

</div>

@endsection