@extends('layout.main')

@section('content')
    <div id="form-container">
        <form action="/validate-login" class="login-form">
            <input type="text" class="form-item, login-form-item" name="email" id="email-login" placeholder="email">
            <input type="text" class="form-item, login-form-item" name="password" id="password-login" placeholder="password">
            <button type="submit" id="form-button">Log in</button>
        </form>
    </div>
@endsection
