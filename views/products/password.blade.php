@extends("layout.main");

@section('content')

    @include('layout.header')


    <section class="page-section contact">
        <div class="container">
            <div class="text-center">
                <h2 class="order text-uppercase">Change your password: </h2>
                <br />
            </div>
            <!-- * * * * * * * * * * * * * * *-->
            <!-- * * SB Forms Contact Form * *-->
            <!-- * * * * * * * * * * * * * * *-->
            <!-- This form is pre-integrated with SB Forms.-->
            <!-- To make this form functional, sign up at-->
            <!-- https://startbootstrap.com/solution/contact-forms-->
            <!-- to get an API token!-->
            <form id="passwordForm" class="contactForm">
                <div class="row align-items-stretch mb-5">


                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6">


                            <!-- Name input-->
                            <div class="form-group">
                                <input class="form-control" id="password" type="password" placeholder="Your password*" data-sb-validations="required" required
                                       oninvalid="this.setCustomValidity('Password is required')"
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
                                <input class="form-control" id="cpassword" type="password" placeholder="Confirm your password*" data-sb-validations="required" required
                                       oninvalid="this.setCustomValidity('COnfirming your password is required')"
                                       oninput="setCustomValidity('')"/>

                            </div>

                        </div>
                        <div class="col-3"></div>
                    </div>



                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    <div class="d-none" id="submitSuccess">
                        <div class="text-center mb-3">
                            <div class="fw-bolder">If you have an account, you have been sent an email with the next steps</div>

                        </div>
                    </div>
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <div class="d-none" id="submitError"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                    <!-- Submit Button-->

                    <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase" id="loginButton" type="submit">Update password</button></div>
                </div>
            </form>
        </div>
    </section>
    <script src="{{scriptUrl('password.js')}}"></script>
    @include('layout.footer')
@endsection
