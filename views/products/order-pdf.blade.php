

@extends("layout.main");

@section('content')
    <style id="inline_style">


    <?php
    echo file_get_contents(stylePath()."\styles.css");
    ?>


    /*#portfolio{*/
    /*    background-color: #0a98b4 !important;*/
    /*}*/
    </style>
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h5 class="price section-subheading text-muted text-uppercase" style="font-size: 90px">Order {{$order["id"]}}</h5>
                <h6 class="price section-subheading text-muted" style="font-size: 60px">{{$order["total_price"]}} RON</h6>

                <h6 class="name section-subheading text-muted">{{$order["first_name"]}} {{$order["last_name"]}}</h6>
                <h6 class="email address section-subheading text-muted">{{$order["email"]}},  {{$order["address"]}}</h6>
            </div>
            <br>
            <br>
            <br>
            <br>

            <br>
            <br>
            <br>
            <br>
            <div class="products text-center">
                <table id="myTable" style="">
                    <tr>
                        <td style="width:100px; height:100px; margin: 50px; border: solid gray 1px"><h6> Id </h6></td>
                        <td style="width:250px; height:100px; margin: 50px; border: solid gray 1px"><h6>Product name</h6></td>
                        <td style="width:100px; height:100px; margin: 50px; border: solid gray 1px"><h6>Quantity</h6></td>
                        <td style="width:100px; height:100px; margin: 50px; border: solid gray 1px"><h6>Price</h6></td>
                    </tr>
                    <br>

                    <br>
                    @foreach($items as $item)

                            <tr>
                                <td style="width:100px; height:100px; margin: 50px; border: solid gray 1px"><h6>{{$item['id']}}</h6></td>
                                <td style="width:250px; height:100px; margin: 50px; border: solid gray 1px"><h6>{{$item['product_name']}}</h6></td>
                                <td style="width:100px; height:100px; margin: 50px; border: solid gray 1px"><h6>{{$item['number_of_units']}}</h6></td>
                                <td style="width:100px; height:100px; margin: 50px; border: solid gray 1px"><h6>{{$item['price']}} RON</h6></td>
                            <!--
                                <td ><h6>{{$item['id']}}</h6></td>
                                <td>{{$item['product_name']}}</td>
                                <td>{{$item['number_of_units']}}</td>
                                <td>{{$item['price']}}</td>-->
                            </tr>
                    @endforeach
                </table>
            </div>

        </div>
    </section>




    <script>

    </script>
@endsection

