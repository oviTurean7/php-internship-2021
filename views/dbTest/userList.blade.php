@extends('layout.main')

@section('content')
    <ul class="user-list">
        @foreach($users as $user)
            <li>
                <div class="user-details">
                    <p class="user-info">ID: <span>{{$user['id']}}</span></p>
                    <p class="user-info">name: <span>{{$user['first_name']}} {{$user['last_name']}}</span></p>
                    <p class="user-info">email: <span>{{$user['email']}}</span></p>
                </div>
            </li>
        @endforeach
    </ul>
@endsection