@extends('layout.main')

@section('content')
    <a href="/show-users?type=proced">TEST PROC DB</a>;
    <a href="/show-users?type=oop">TEST OOP DB</a>;
    <a href="/show-users?type=pdo">TEST PDO DB</a>;
@endsection
