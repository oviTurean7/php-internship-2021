<?php
use App\Session\Session;
require 'C:\xampp\htdocs\PHP Training\app\Cart\Session\Session.php';

$session = new Session();
$cart = $session->get('cart');
$quantities = $session->get('quantities');
if (!isset($cart)) {
    $cartItems = [];
} else
    $cartItems = $cart;

foreach ($cartItems as $productId)
    if (!isset($quantities[$productId]))
        $quantities[$productId] = 1;
if (isset($_GET['addId']))
    $quantities[$_GET['addId']]++;

if (isset($_GET['decId']) && $quantities[$_GET['decId']] > 1)
    $quantities[$_GET['decId']]--;

if (!isset($sum))
    $sum = 0;

var_dump($_SESSION);
?>

@extends('layout.main')

@section('content')
    <div class="data-container">
        <div class="user-data">Username: {{$username}}</div>
        <div class="user-data">First Name: {{$firstName}}</div>
        <div class="user-data">Last Name: {{$lastName}}</div>

        <div>
            <h3>SHOPPING CART</h3>
            <table>
                @foreach ($cartItems as $productId)
                    <?php if(isset($products)) $sum += $quantities[$productId] * $products[array_search($productId, array_column($products, 'id'))]['price'] ?>
                    <tr>
                        <input type="hidden" name="prodID" value="{{$productId}}">
                        <th id="name">{{$products[array_search($productId, array_column($products, 'id'))]['name']}} </th>
                        <td id="description">{{$products[array_search($productId, array_column($products, 'id'))]['description']}} </td>
                        <td id="price">{{$_SESSION['quantities'][$productId]*$products[array_search($productId, array_column($products, 'id'))]['price']}}
                            RON
                        </td>
                        <td id="quantity-{{$productId}}">{{$_SESSION['quantities'][$productId]}}</td>
                        <td>
                            <button class="add-button">+</button>
                        </td>
                        <td>
                            <button class="dec-button">-</button>
                        </td>
                        <td>
                            <button class="remove-button">DELETE</button>
                        </td>
                    </tr>
                @endforeach
            </table>
            <div class="total-sum">TOTAL {{$sum}}</div>
            <div>
                <form class="place-order">
                    <input type="text" name="first-name" placeholder="First Name">
                    <input type="text" name="last-name" placeholder="Last Name">
                    <input type="email" name="email" placeholder="Email Address">
                    <textarea name="address" placeholder="Address"></textarea>
                    <img src="./images/user.jfif">
                    <button class="order-button">PLACE ORDER</button>
                </form>
            </div>
        </div>
    </div>
@endsection
