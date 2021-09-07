@extends('layout.main')

@section('content')
    <div>
        <ul>
            <li>{{$user1[0]}}, {{$user1[1]}}, {{$user1[2]}}</li>
            <li>{{$user2[0]}}, {{$user2[1]}}, {{$user2[2]}}</li>
        </ul>
        <div class="login-container">
            <h3>LOG IN</h3>
            <form method="post" action="login.php" name="login-form">
                <div class="form-element">
                    <label></label>
                    <input type="email" name="email" placeholder="Email" required/>
                </div>
                <div class="form-element">
                    <label></label>
                    <input type="password" name="password" placeholder="Password" required />
                </div>
                <button type="submit" name="login" value="login">Log In</button>
            </form>
        </div>
    </div>
@endsection
