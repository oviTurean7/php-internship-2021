@extends("layout.main");

@section('content')

    @include('layout.header')


    <section class="page-section contact">
        <div class="container">
            <div class="text-center">
                <h2 class="order text-uppercase">Write your credetials: </h2>
                <br />
            </div>
            <!-- * * * * * * * * * * * * * * *-->
            <!-- * * SB Forms Contact Form * *-->
            <!-- * * * * * * * * * * * * * * *-->
            <!-- This form is pre-integrated with SB Forms.-->
            <!-- To make this form functional, sign up at-->
            <!-- https://startbootstrap.com/solution/contact-forms-->
            <!-- to get an API token!-->
            <form id="loginForm" class="contactForm">
                <div class="row align-items-stretch mb-5">


                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6">


                            <!-- Name input-->
                            <div class="form-group">
                                <input class="form-control" id="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" required
                                       oninvalid="this.setCustomValidity('Please enter a valid email')"
                                       oninput="setCustomValidity('')"/>
                            </div>

                        </div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6">


                            <!-- Name input-->
                            <div class="form-group">
                                <input class="form-control" id="password" type="password" placeholder="Your Password *" data-sb-validations="required,email" required
                                       oninvalid="this.setCustomValidity('Please enter your password')"
                                       oninput="setCustomValidity('')"/>
                            </div>

                        </div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6 align-content-center">


                            <!-- Name input-->
                            <a  href="http://php.local/login/forgot-password">Forgot your password?</a>

                        </div>
                        <div class="col-3"></div>

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

                <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase" id="loginButton" type="submit">Log in</button></div>
                </div>
            </form>
        </div>
    </section>
    <script src="{{scriptUrl('login.js')}}"></script>
    @include('layout.footer')
@endsection
