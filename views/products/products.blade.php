@extends('layout.main')

@section('content')
    <button onclick="exportProducts()">Export</button>
    <table id="products" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Units</th>
                <th>Category</th>
            </tr>
        </thead>
    </table>

@endsection