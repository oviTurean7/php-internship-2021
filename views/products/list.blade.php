@extends('layout.main')

@section('content')
<div class="data-container">
    <div class="user-data">Username: {{$username}}</div>
    <div class="user-data">First Name: {{$firstName}}</div>
    <div class="user-data">Last Name: {{$lastName}}</div>

    <div>
        <h3>PRODUCT LIST</h3>
        <table>
                @foreach ($products as $product)
                <tr>
                    <input type="hidden" name="prodID" value="{{$product['id']}}">
                    <th id="name" class="sortBy">{{$product['name']}} </th>
                    <td id="description">{{$product['description']}} </td>
                    <td id="units" class="sortBy">{{$product['units']}} Units</td>
                    <td id="price" class="sortBy">{{$product['price']}} RON</td>
                    <td class="cart-button"><button>ADD TO CART</button></td>
                </tr>
                @endforeach
        </table>
    </div>
</div>
@endsection
