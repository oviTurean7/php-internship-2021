@extends('layout.main')

@section('content')

    <table id="orders" class="display">
        <thead>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Total price</th>
        </tr>
        </thead>
    </table>
    <table id="order_items" class="display">
        <thead>
        <tr>
            <th>ID</th>
            <th>Product ID</th>
            <th>Units number</th>
            <th>Price</th>
        </tr>
        </thead>
    </table>
@endsection