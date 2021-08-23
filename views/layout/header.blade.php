<div>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="http://php.local/"><img src="{{assetUrl('img/navbar-logo.svg')}}" alt="..." /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="http://php.local/signup" id="signup">Sign up</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" id="logging">Log in</a></li>
                    <li class="nav-item"><a class="nav-link" href="http://php.local/">Portfolio</a></li>
                    <!--<li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>-->
                    <li class="nav-item" id="cart"><a class="nav-link" href="http://php.local/cart"><i class="fas fa-shopping-cart"></i><span id="numberOfProducts"> {{$_SESSION['cart']->getNumberOfItems()}}</span></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading">Welcome To Our Studio!</div>
            <div class="masthead-heading text-uppercase">It's Nice To Meet You</div>
            <a class="btn btn-primary btn-xl text-uppercase" href="#services">Tell Me More</a>
        </div>
    </header>
</div>


