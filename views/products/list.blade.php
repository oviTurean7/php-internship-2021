@extends("layout.main");

@section('content')

    @include('layout.header')
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Portfolio</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <form class="sorting-options">
                    Sort by:

                    <input id="prductName" class="radioSort" type="radio" name="sort" value="name">
                    <label for="productName">     name </label>

                    <input id="productDescription" class="radioSort" type="radio" name="sort" value="description">
                    <label for="productDescription">     description </label>

                    <input id="productPrice" class="radioSort" type="radio" name="sort" value="price">
                    <label for="productPrice">  price  </label>
                    <span id="sort" class="up float-end"> ᐱ</span>
                </form>

                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-lg-4 col-sm-6 mb-4">
                            <!-- Portfolio item 1-->
                            <div class="portfolio-item">
                                <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1">
                                    <div class="portfolio-hover">
                                        <!--<div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>-->
                                    </div>
                                    <img class="img-fluid" src="{{$product['url']}}" alt="..." />
                                </a>
                                <div class="portfolio-caption">
                                    <div class="portfolio-caption-heading">{{$product['name']}}</div>
                                    <div class="portfolio-caption-subheading text-muted">{{ $product['description']}}</div>
                                    <div class="portfolio-caption-subheading text-muted">{{ $product['price']}} RON</div>
                                    <form class="cart-button"><input type="text" value="{{$product['id']}}" hidden> <button type="submit" class="btn btn-primary btn-xl text-uppercase">Add to cart</button></form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    <div class="modal-container">
        <div class="portfolio-modal modal fade show" id="modal" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal"></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Success!</h2>
                                    <p class="item-intro text-muted">The item was added to cart</p>
                                    <p id="items"> Items: {{$_SESSION['cart']->getNumberOfItems()}}</p>
                                    <p id="total"> Total price: {{$_SESSION['cart']->getTotalPrice()}}</p>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layout.footer')
@endsection




