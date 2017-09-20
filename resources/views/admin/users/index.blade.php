@extends('layouts.admin')

@section('content')

    <h1>Admin index Users Page</h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created_At</th>
            <th>Updated_At</th>
        </tr>
        </thead>
        <tbody>

        @if($users)

            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at->diffForHumans()}}</td>
                <td>{{$user->upted_at}}</td>
            </tr>
            @endforeach

        @endif


        </tbody>
    </table>

@endsection

