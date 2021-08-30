<!DOCTYPE html>
<html lang="en">
<head>
    <title>Internship</title>
    <link rel="stylesheet" href="{{styleUrl('main.css')}}">
    <link rel="stylesheet" href="{{styleUrl('styles.css')}}">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{assetUrl('favicon.ico')}}"/>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css"/>
    <link href="//cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <!-- jQuery library -->


    <!-- Latest compiled JavaScript -->


    <!-- Core theme CSS (includes Bootstrap)-->
    @yield('additional-css')
</head>
<body>


<script src="//cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>

@yield('content')
<script src="{{scriptUrl('main.js')}}"></script>
@yield('additional-scripts')

</body>
</html>
