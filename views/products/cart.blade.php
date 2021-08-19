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
        <form action="/submit-buyer-info" method="post" onsubmit="return validateBuyer()">
        <label for="fname">First name:</label>
            <input type="text" id="fname" name="fname"><br><br>
            <label for="lname">Last name:</label>
            <input type="text" id="lname" name="lname"><br><br>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email"><br><br>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address"><br><br>
            <label for="image">Image:</label>
            <input type="image" id="image" name="image"><br><br>
            <input type="submit" value="Buy">
        </form>
    </div>
@endsection