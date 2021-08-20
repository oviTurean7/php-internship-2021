<?php
//session_start();
//session_unset();

if (empty($_SESSION["columns"])) {
    $_SESSION["columns"] = array('name' => 'asc', 'units' => 'asc', 'price' => 'asc');
}

//$col = $_GET['sort'];
//$_SESSION['column']['name'] = 'desc';

setcookie("lastLoad", date("d/m/y, h:i:sa"), time() + 60 * 60 * 24 * 60);
if (isset($_COOKIE['lastLoad'])) {
    echo $_COOKIE['lastLoad'], '<br>';
}
setcookie("lastLoad", "", time() - 3600);

print_r($_SESSION);
?>

        <!DOCTYPE html>
<html lang="en">
<head>
    <title>Main Page</title>
    <link rel="stylesheet" href="{{styleUrl('main.css')}}">
    @yield('additional-css')
</head>
<body>
@include('layout.header')
@yield('content')
@yield('cart')
@include('layout.footer')

<script src="{{scriptUrl('jquery-3.4.1.js')}}"></script>
<script src="{{scriptUrl('main.js')}}"></script>
@yield('additional-scripts')
</body>
</html>
