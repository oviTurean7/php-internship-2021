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
                        <td>
                            <button class="cart-button">ADD TO CART</button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <form action="index.php/" method="POST" enctype="multipart/form-data">
            <input type="file" name="file" id="file">
            <input type="submit" name="submit" value="Upload">
        </form>
    </div>
@endsection


<?php
if (isset($_POST["submit"])) {
    $allowed = array("txt" => true);
    $name = $_FILES['file']['name'];
    $source = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];
    $save = "public/images/" . $name;
    $maxSize = 1024 * 1024 * 10;
    $extension = explode(".", $name);
    if (!empty($allowed[strtolower($nameext[1])]) && $allowed[strtolower($extension[1])] === true) {
        if ($size <= $maxSize) {
            if (!file_exists($save)) {
                if (move_uploaded_file($source, $save)) {
                    chmod($save, 644);
                    echo "Successful upload.";
                } else echo "Cannot move";
            } else echo "Existing file";
        } else echo "Too big file";
    } else echo "Not allowed extension";
} else echo 'Not set<br>';

?>