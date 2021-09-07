@extends('layout.main')

@section('content')
    <div>
        <ul>
            <li>{{$user1[0]}}, {{$user1[1]}}, {{$user1[2]}}</li>
            <li>{{$user2[0]}}, {{$user2[1]}}, {{$user2[2]}}</li>
        </ul>
        <div class="login-container">
            <h3>REGISTER</h3>
            <form method="POST" action="register.php" name="signup-form">
                <div class="form-element">
                    <input type="text" name="firstname" placeholder="First Name" required />
                </div>
                <div class="form-element">
                    <input type="text" name="lastname" placeholder="Last Name" required />
                </div>
                <div class="form-element">
                    <input type="email" name="email" placeholder="Email" required />
                </div>
                <div class="form-element">
                    <input type="password" name="password" placeholder="Password" required />
                </div>
                <button type="submit" name="register" value="register">Register</button>
            </form>
        </div>
    </div>
@endsection