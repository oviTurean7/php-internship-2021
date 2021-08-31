

@extends("layout.main");

@section('content')

    @include('layout.header')
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h2 class="title section-heading text-uppercase">Order {{$order["id"]}}</h2>
                <h6 class="price section-subheading text-muted">{{$order["total_price"]}} RON</h6>
                <h6 class="name section-subheading text-muted">{{$order["first_name"]}} {{$order["last_name"]}}</h6>
                <h6 class="email address section-subheading text-muted">{{$order["email"]}},  {{$order["address"]}}</h6>
                <h6 class="photo address section-subheading text-muted"><img style="height: 200px; width: auto" src='{{$order["image_url"]}}' ></h6>
            </div>

            <div class="products">
                <table id="myTable">

                </table>
            </div>

        </div>
    </section>



    <script src="{{scriptUrl('order-details.js')}}"></script>
    @include('layout.footer')
@endsection


