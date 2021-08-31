@extends("layout.main");

@section('content')

    @include('layout.header')
    <!--
    <style id="inline_style">



         echo file_get_contents(stylePath()."\styles.css");



         /*#portfolio{*/
        /*    background-color: #0a98b4 !important;*/
        /*}*/
    </style>-->
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Orders</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>

            <div class="categories">
                <table id="myTable">

                </table>
            </div>

        </div>
    </section>
    <div class="modal-container">
        <div class="portfolio-modal modal modal-add-update fade show" tabindex="-1" style="display: none;"
             aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg"
                                                                          alt="Close modal"></div>
                    <div class="container">
                        <div class="text-center">
                            <h2 class="category text-uppercase">Order: </h2>
                            <br/>
                        </div>
                        <form id="categoryForm" class="contactForm">
                            <div class="row align-items-stretch mb-5">


                                <div class="row">
                                    <div class="col-3"></div>
                                    <div class="col-6">


                                        <!-- Name input-->
                                        <div class="form-group">
                                            <input class="m-2 form-control" id="name" type="text" placeholder="Name *"
                                                   required
                                                   oninvalid="this.setCustomValidity('Please enter a name')"
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
                                            <textarea class="m-2 form-control" id="briefing"
                                                      oninput="setCustomValidity('')"
                                                      oninvalid="this.setCustomValidity('Please enter a briefing')"
                                                      placeholder="Briefing *"

                                                      type="text"></textarea>
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
                                        <div class="fw-bolder">If you have an account, you have been sent an email with
                                            the next steps
                                        </div>

                                    </div>
                                </div>
                                <!-- Submit error message-->
                                <!---->
                                <!-- This is what your users will see when there is-->
                                <!-- an error submitting the form-->
                                <div class="d-none" id="submitError">
                                    <div class="text-center text-danger mb-3">Error sending message!</div>
                                </div>
                                <!-- Submit Button-->

                                <div class="text-center">
                                    <button class="btn m-5 btn-primary btn-xl text-uppercase" id="addUpdateButton"
                                            type="submit">Add
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-container">
        <div class="portfolio-modal modal modal-delete fade show" tabindex="-1" style="display: none;" aria-modal="true"
             role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!--<div class="close-modal-delete" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal"></div>-->
                    <div class="container">
                        <div class="text-center">
                            <h2 class="delete-category text-uppercase">Are you sure you want to delete category 2? </h2>
                            <br/>
                        </div>

                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-3">
                                <div class="text-center">
                                    <button class="btn m-5 btn-primary btn-xl text-uppercase" id="yesButton"
                                            type="button">Yes
                                    </button>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="text-center">
                                    <button class="btn m-5 btn-primary btn-xl text-uppercase" id="noButton"
                                            type="button">No
                                    </button>
                                </div>
                            </div>
                            <div class="col-3"></div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{scriptUrl('orders.js')}}"></script>
    @include('layout.footer')
@endsection


