@extends('layout.main')

@section('content')
    <div>
        <div class="table-container">
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
                            <button onclick="location.href='add-product.php?id={{$product['id']}}'">Add to cart</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection