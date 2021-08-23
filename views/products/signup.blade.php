@extends("layout.main");

@section('content')
    @include('layout.header')

    <section class="page-section contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="order text-uppercase">sign up</h2>
                    <br />
                </div>
                <!-- * * * * * * * * * * * * * * *-->
                <!-- * * SB Forms Contact Form * *-->
                <!-- * * * * * * * * * * * * * * *-->
                <!-- This form is pre-integrated with SB Forms.-->
                <!-- To make this form functional, sign up at-->
                <!-- https://startbootstrap.com/solution/contact-forms-->
                <!-- to get an API token!-->
                <form id="signupForm" class="contactForm">
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
                                    <input class="form-control" id="lastName" type="text" placeholder="Your Last Name *" data-sb-validations="required" required
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
                                    <input class="form-control" id="tel" type="tel" placeholder="Your phone number*" data-sb-validations="required" required
                                           oninvalid="this.setCustomValidity('Phone number is required')"
                                           oninput="setCustomValidity('')"/>

                                </div>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-6">


                                <!-- Name input-->
                                <div class="form-group">
                                    <input class="form-control" id="password" type="password" placeholder="Your password*" data-sb-validations="required" required
                                           oninvalid="this.setCustomValidity('Password is required')"
                                           oninput="setCustomValidity('')"/>
                                </div>

                            </div>
                            <div class="col-6">
                                <!-- Email address input-->
                                <div class="form-group">
                                    <input class="form-control" id="cpassword" type="password" placeholder="Confirm your password*" data-sb-validations="required" required
                                           oninvalid="this.setCustomValidity('COnfirming your password is required')"
                                           oninput="setCustomValidity('')"/>

                                </div>

                            </div>
                        </div>
                        <div class="row align-items-stretch mb-5">
                            <div class="form-group">
                                <!--<input class="form-control" id="picture" type="file" placeholder="Your Name *" data-sb-validations="required" style="display:none;" required/>
                                <label for="picture">Click me to upload image</label>-->
                                <input class="form-control" id="address" type="text" placeholder="Address *" data-sb-validations="required" required
                                       oninvalid="this.setCustomValidity('Address is required')"
                                       oninput="setCustomValidity('')"/>
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

                        <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase" id="submitButton" type="submit">Sign up</button></div>
                    </div>
                </form>
            </div>
        </section>
    <script src="{{scriptUrl('signup.js')}}"></script>
        @include('layout.footer')
        @endsection