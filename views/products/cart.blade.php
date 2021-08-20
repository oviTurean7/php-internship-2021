<?php
session_start();
$cartItems = $_SESSION['cart'];
print_r($cartItems);
if (!isset ($cnt))
    $cnt = 1;
else
    $cnt = $_POST['productCount'];
?>

@extends('layout.main')

@section('cart')
    <div class="data-container">
        <div class="user-data">Username: {{$username}}</div>
        <div class="user-data">First Name: {{$firstName}}</div>
        <div class="user-data">Last Name: {{$lastName}}</div>

        <div>
            <h3>SHOPPING CART</h3>
            <table>
                @foreach ($cartItems as $productId)
                    <tr>
                        <input type="hidden" name="prodID" value="{{$productId}}">
                        <th id="name">{{$products[array_search($productId, array_column($products, 'id'))]['name']}} </th>
                        <td id="description">{{$products[array_search($productId, array_column($products, 'id'))]['description']}} </td>
                        <td id="price">{{$products[array_search($productId, array_column($products, 'id'))]['price']}}RON</td>
                        <td id="units">{{$cnt}}</td>
                        <td>
                            <button class="add-button">+</button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
