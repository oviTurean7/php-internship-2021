@extends('layout.main')

@section('content')
    <div>
        <form action="/register" class="login-form">
            <input type="text" id="fname" name="fname" placeholder="first name">
            <input type="text" id="lname" name="lname" placeholder="last name">
            <input type="text" id="address" name="address" placeholder="address">
            <input type="text" id="email" name="email" placeholder="email">
            <input type="text" name="password" id="password" placeholder="password">
            <button type="submit">Register</button>
        </form>
    </div>
@endsection
