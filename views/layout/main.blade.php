<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Internship</title>
        <link rel="stylesheet" href="{{styleUrl('main.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        @yield('additional-css')
    </head>
    <body class="mainContainer">
    @include('layout.header')
    @yield('content')
    @include('layout.footer')

    <script src="{{scriptUrl('jquery-3.4.1.js')}}"></script>
    <script src="{{scriptUrl('main.js')}}"></script>
    @yield('additional-scripts')
    </body>
</html>
