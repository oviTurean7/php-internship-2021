

@extends("layout.main");

@section('content')

    @include('layout.header')
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Products</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>

            <div class="products">
                <table id="myTable">

                </table>
            </div>

        </div>
    </section>
    <div class="modal-container">
        <div class="portfolio-modal modal modal-add-update fade show"  tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal"></div>
                    <div class="container">
                        <div class="text-center">
                            <h2 class="product text-uppercase">product: </h2>
                            <br />
                        </div>
                        <form id="productForm" class="contactForm">
                            <div class="row align-items-stretch mb-5">


                                <div class="row">

                                    <div class="col-6">


                                        <!-- Name input-->
                                        <div class="form-group">
                                            <input class="m-2 form-control" id="name" type="text" placeholder="Name *"  required
                                                   oninvalid="this.setCustomValidity('Please enter a name')"
                                                   oninput="setCustomValidity('')"/>
                                        </div>

                                    </div>
                                    <div class="col-6">



                                        <div class="form-group">
                                            <input class="m-2 form-control" id="description" type="text" placeholder="Description *"  required
                                                   oninvalid="this.setCustomValidity('Please enter a descrption')"
                                                   oninput="setCustomValidity('')"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="number" class="m-2 form-control" id="units" oninput="setCustomValidity('')"
                                                      oninvalid="this.setCustomValidity('Please enter a briefing')" placeholder="Units *"

                                                      type="text">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="number" class="m-2 form-control" id="price" oninput="setCustomValidity('')"
                                                   oninvalid="this.setCustomValidity('Please enter a briefing')" placeholder="Price *"

                                                   type="text">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <select required class="m-2 form-control" name="categoryId" id="categoryId" oninput="setCustomValidity('')"
                                                    oninvalid="this.setCustomValidity('Please enter a briefing')">
                                                <option value="" class="gray" disabled selected hidden>Category id *</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-12">


                                        <div class="form-group">
                                            <textarea class="m-2 form-control" id="url" oninput="setCustomValidity('')"
                                                      oninvalid="this.setCustomValidity('Please enter an url')" placeholder="Url *"

                                                      type="text"></textarea>
                                        </div>

                                    </div>
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

                                <div class="text-center"><button class="btn m-5 btn-primary btn-xl text-uppercase" id="addUpdateButton" type="submit">Add</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-container">
        <div class="portfolio-modal modal modal-delete fade show"  tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!--<div class="close-modal-delete" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal"></div>-->
                    <div class="container">
                        <div class="text-center">
                            <h2 class="delete-product text-uppercase">Are you sure you want to delete product 2? </h2>
                            <br />
                        </div>

                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-3"><div class="text-center"><button class="btn m-5 btn-primary btn-xl text-uppercase" id="yesButton" type="button">Yes</button></div></div>
                            <div class="col-3"><div class="text-center"><button class="btn m-5 btn-primary btn-xl text-uppercase" id="noButton" type="button">No</button></div></div>
                            <div class="col-3"></div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{scriptUrl('products.js')}}"></script>
    @include('layout.footer')
@endsection


