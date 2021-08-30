


<section class="page-section contact background">
    <div class="container ">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Submit file</h2>
            <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
        </div>
        <!-- * * * * * * * * * * * * * * *-->
        <!-- * * SB Forms Contact Form * *-->
        <!-- * * * * * * * * * * * * * * *-->
        <!-- This form is pre-integrated with SB Forms.-->
        <!-- To make this form functional, sign up at-->
        <!-- https://startbootstrap.com/solution/contact-forms-->
        <!-- to get an API token!-->

        <form id="fileForm" data-sb-form-api-token="API_TOKEN">
            <!--
           <div class="row align-items-stretch mb-5">
               <div class="col-md-6">
                   <div class="form-group">

                       <input class="form-control" id="name" type="text" placeholder="Your Name *" data-sb-validations="required" />
                       <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                   </div>
                   <div class="form-group">

                       <input class="form-control" id="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" />
                       <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                       <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                   </div>
                   <div class="form-group mb-md-0">

                       <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" data-sb-validations="required" />
                       <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="form-group form-group-textarea mb-md-0">

                       <textarea class="form-control" id="message" placeholder="Your Message *" data-sb-validations="required"></textarea>
                       <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                   </div>
               </div>
           </div>-->
            <!-- Submit success message-->
            <!---->
            <!-- This is what your users will see when the form-->
            <!-- has successfully submitted-->
            <div class="row align-items-stretch mb-5">
                <div class="form-group">

                    <input class="form-control" id="file" type="file" placeholder="Your Name *" data-sb-validations="required" required/>
                </div>
            </div>
            <div class="d-none" id="submitSuccessMessage">
                <div class="text-center text-white mb-3">
                    <div class="fw-bolder">File submission successful!</div>

                </div>
            </div>
            <!-- Submit error message-->
            <!---->
            <!-- This is what your users will see when there is-->
            <!-- an error submitting the form-->
            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
            <!-- Submit Button-->
            <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase " id="submitFileButton" type="submit">Submit file</button></div>
        </form>
    </div>
</section>
<!-- Footer-->
<footer class="footer py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-lg-start">Copyright &copy; Your Website 2021</div>
            <div class="col-lg-4 my-3 my-lg-0">
                <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
            </div>
        </div>
    </div>
</footer>