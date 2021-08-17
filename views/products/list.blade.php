@extends('layout.main')

@section('content')
<div>
    <div>UserName: {{$username}}</div>
    <div>First Name: {{$firstName}}</div>
    <div>Last Name: {{$lastName}}</div>

    <div>
        <h3>My list of products - you'll use a nice table</h3>
        <ul>
            @foreach ($products as $product)
                <li>{{$product['name']}} <span> -  {{ $product['price']}} RON</span></li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
