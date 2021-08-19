@extends('layout.main')

@section('content')
    <div class="pageContainer">
        <div class="cartIconContainer">
            <p id="successCart">Success - Prod. No. <span id="prodNum"></span> Total <span id="totalCost"></span></p>
            <i class="fa fa-shopping-cart" id="cartIcon" onclick="location.href='/cart'"></i>
        </div>
        <table class="product-table">
            <thead>
            <tr>
                <th class='clickableHeader' onclick="location.href='table-sort.php?sort=name'">
                    Name
                    <div class="arrow arrowDown" data-value="name" ></div>
                </th>
                <th>
                    Description
                </th>
                <th class='clickableHeader' onclick="location.href='table-sort.php?sort=price'">
                    Price
                    <div class="arrow arrowDown" data-value="price"></div>
                </th>
                <th>
                    Actions
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product['name']}}</td>
                    <td>{{$product['description']}}</td>
                    <td>{{$product['price']}} RON</td>
                    <td>
                        <button onclick="addToCart({{json_encode($product)}})">Add to cart</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection