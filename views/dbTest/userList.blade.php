@extends('layout.main')

@section('content')
    <ul>
        @foreach($users as $user)
            <li>
                <div>
                    <p>{{$user['id']}}</p>
                    <p>{{$user['first_name']}}</p>
                    <p>{{$user['last_name']}}</p>
                </div>
            </li>
        @endforeach
    </ul>
@endsection