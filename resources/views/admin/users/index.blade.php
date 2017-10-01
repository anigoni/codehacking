@extends('layouts.admin')

@section('content')

    <h1>Admin index Users Page</h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created_At</th>
            <th>Updated_At</th>
        </tr>
        </thead>
        <tbody>

        @if($users)

            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td><img height="50" src="{{$user->photo ? $user->photo->file : 'http://placehold.it/400x400'}}" alt=""></td>
                {{--sopra, quando richiamo attributo photo, ritorna anche il PATH di dove è la foto--}}
                <td><a href="{{route('admin.users.edit', $user->id)}}"> {{$user->name}}</a></td>
                <td>{{$user->email}}</td>
                <td>{{$user->role->name}}</td>
                <td>{{$user->is_active == 1 ? 'Active' : 'Not Active'}}</td>
                <td>{{$user->created_at->diffForHumans()}}</td>
                <td>{{$user->updated_at == NULL ? 'Not Updated' : $user->updated_at->diffForHumans()}}</td>
                <td>{{$user->upted_at}}</td>
            </tr>
            @endforeach

        @endif


        </tbody>
    </table>

@endsection

