@extends("layout.main");

@section('content')

    @include('layout.header')

    <div>
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Cart</h2>
                </div>


                <div id="cartContent" class="row">


                </div>
            </div>
        </section>
    </div>
    <section class="page-section contact">
        <div class="container">
            <div class="text-center">
                <h2 class="order text-uppercase">Place order</h2>
                <br />
            </div>
            <!-- * * * * * * * * * * * * * * *-->
            <!-- * * SB Forms Contact Form * *-->
            <!-- * * * * * * * * * * * * * * *-->
            <!-- This form is pre-integrated with SB Forms.-->
            <!-- To make this form functional, sign up at-->
            <!-- https://startbootstrap.com/solution/contact-forms-->
            <!-- to get an API token!-->
            <form id="contactForm" class="contactForm">
                <div class="row align-items-stretch mb-5">
                    <div class="row">

                        <div class="col-6">


                            <!-- Name input-->
                            <div class="form-group">
                                <input class="form-control" id="firstName" type="text" placeholder="Your First Name *" data-sb-validations="required" required
                                       oninvalid="this.setCustomValidity('First name is required.')"
                                       oninput="setCustomValidity('')"/>
                            </div>

                        </div>
                        <div class="col-6">
                            <!-- Email address input-->
                            <div class="form-group">
                                <input class="form-control" id="lastName" type="text" placeholder="Your Last Name *" data-sb-validations="required"
                                       oninvalid="this.setCustomValidity('Last name is required.')"
                                       oninput="setCustomValidity('')"/>
                            </div>

                        </div>
                    </div>
                    <div class="row">

                        <div class="col-6">


                            <!-- Name input-->
                            <div class="form-group">
                                <input class="form-control" id="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" required
                                       oninvalid="this.setCustomValidity('Please enter a valid email')"
                                       oninput="setCustomValidity('')"/>
                            </div>

                        </div>
                        <div class="col-6">
                            <!-- Email address input-->
                            <div class="form-group">
                                <input class="form-control" id="address" type="text" placeholder="Address *" data-sb-validations="required" required
                                       oninvalid="this.setCustomValidity('Adress is required')"
                                       oninput="setCustomValidity('')"/>

                            </div>

                        </div>
                    </div>
                    <div class="row align-items-stretch mb-5">
                            <div class="form-group">
                                <!--<input class="form-control" id="picture" type="file" placeholder="Your Name *" data-sb-validations="required" style="display:none;" required/>
                                <label for="picture">Click me to upload image</label>-->
                                <div class="input-group mb-3 bg-white shadow-sm form-control">
                                    <div class="text-uppercase font-weight-bold text-muted">Upload your picture</div>

                                    <input  id="upload" type="file" class="form-control border-0">

                                    <div class="input-group-append">

                                        <label for="upload" class="btn btn-light"> <small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                                    </div>
                                </div>

                                <!-- Uploaded image area-->
                                <p class="font-italic text-white text-center">The image uploaded will be rendered inside the box below.</p>
                                <div id="insertImage" class="image-area mt-4"></div>
                            </div>
                    </div>


                <!-- Submit success message-->
                <!---->
                <!-- This is what your users will see when the form-->
                <!-- has successfully submitted-->
                <div class="d-none" id="submitSuccess">
                    <div class="text-center mb-3">
                        <div class="fw-bolder">Form submission successful!</div>

                    </div>
                </div>
                <!-- Submit error message-->
                <!---->
                <!-- This is what your users will see when there is-->
                <!-- an error submitting the form-->
                <div class="d-none" id="submitError"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                <!-- Submit Button-->

                <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase" id="submitButton" type="submit">Place order</button></div>
                </div>
            </form>
        </div>
    </section>
    <script src="{{scriptUrl('cart.js')}}"></script>
    <link rel="stylesheet" href="{{styleUrl('cart.css')}}">
    @include('layout.footer')
@endsection
