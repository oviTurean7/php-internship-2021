<!DOCTYPE html>
<html lang="en">
<head>
    <title>Internship</title>
    <link rel="stylesheet"
          href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.11.0/b-2.0.0/sl-1.3.3/datatables.min.css"/>
    <link rel="stylesheet" href="<?php echo scriptUrl('editor/css/editor.dataTables.css');?>">
    <link rel="stylesheet" href="{{styleUrl('main.css')}}">
    @yield('additional-css')
</head>
<body class="mainContainer">
@include('layout.header')
@yield('content')
@include('layout.footer')

{{--<script src="<?php echo scriptUrl('jquery-3.4.1.js');?>"></script>--}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.11.0/b-2.0.0/sl-1.3.3/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="<?php echo scriptUrl('editor/js/dataTables.editor.js');?>"></script>

<script src="<?php echo scriptUrl('main.js')?>"></script>
@yield('additional-scripts')
</body>
</html>
