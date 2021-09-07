<?php
//use App\Session\Session;
//require 'C:\xampp\htdocs\PHP Training\app\Cart\Session\Session.php';
//
//$session = new Session();
//$col = $session->get('columns');
//if (empty($col)) {
//    $col = array('name' => 'asc', 'units' => 'asc', 'price' => 'asc');
//}

setcookie("lastLoad", date("d/m/y, h:i:sa"), time() + 60 * 60 * 24 * 60);
if (isset($_COOKIE['lastLoad'])) {
    echo $_COOKIE['lastLoad'], '<br>';
}
setcookie("lastLoad", "", time() - 3600);
echo "<br>";
?>

        <!DOCTYPE html>
<html lang="en">
<head>
    <title>Internship</title>
    <link rel="stylesheet" href="{{styleUrl('main.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.0/datatables.min.css"/>
    @yield('additional-css')
</head>
<body>

@include('layout.header')
@yield('content')
@include('layout.footer')

<script src="{{scriptUrl('jquery-3.4.1.js')}}"></script>
<script src="{{scriptUrl('main.js')}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.0/datatables.min.js">
    $(document).ready(function () {
        $('#table_id').DataTable();
    });
</script>
@yield('additional-scripts')
</body>
</html>
