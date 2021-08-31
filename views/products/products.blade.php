@extends('layout.main')

@section('content')
    <button onclick="exportProducts()">Export</button>
    <button onclick="location.href='products-editor/import-template'">Import template</button>
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
    <form action='products-editor/import-data' method="POST" enctype="multipart/form-data" id="fileForm">
        <label for="file">File:</label>
        <input type="file" name="file">
    </form>
    <button type="submit" form="fileForm">Import data</button>

@endsection