@extends('layout.main')

@section('content')
    <div>
        <form action="/validate-login" class="login-form">
            <input type="text" name="email" id="email-login" placeholder="email">
            <input type="text" name="password" id="password-login" placeholder="password">
            <button type="submit">Log in</button>
        </form>
    </div>
@endsection
