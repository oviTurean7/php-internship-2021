@extends('layout.main')

@section('content')
    <div class="pageContainer">
        <table class="product-table">
            <thead>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Description
                </th>
                <th>
                    Price
                </th>
                <th>
                    Quantity
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product['name']}}</td>
                    <td>{{$product['description']}}</td>
                    <td>{{$product['price']}} RON</td>
                    <td>{{$product['quantity']}}</td>
                    <td>
                        <button onclick="updateQuantity({{json_encode($product)}}, -1)">-</button>
                        <button onclick="updateQuantity({{json_encode($product)}}, 1)">+</button>
                    </td>
                    <td>
                        <button onclick="removeProductFromCart({{$product['id']}})">remove</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection