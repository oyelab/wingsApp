@extends('backEnd.layouts.master')
@section('title')
    Product Detail
@endsection
@section('css')
    <!-- swiper css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}">
@endsection
@section('page-title')
    Product Detail
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="product-detail mt-3" dir="ltr">

                                    <div
                                        class="swiper product-thumbnail-slider rounded border overflow-hidden position-relative">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide rounded">
                                                <div class="p-3">
                                                    <div class="product-img bg-light rounded p-3">
                                                        <img src="{{ URL::asset('build/images/product/img-1.png') }}"
                                                            class="img-fluid d-block" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="swiper-slide rounded">
                                                <div class="p-3">
                                                    <div class="product-img bg-light rounded p-3">
                                                        <img src="{{ URL::asset('build/images/product/img-2.png') }}"
                                                            class="img-fluid d-block" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="swiper-slide rounded">
                                                <div class="p-3">
                                                    <div class="product-img bg-light rounded p-3">
                                                        <img src="{{ URL::asset('build/images/product/img-3.png') }}"
                                                            class="img-fluid d-block" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="swiper-slide rounded">
                                                <div class="p-3">
                                                    <div class="product-img bg-light rounded p-3">
                                                        <img src="{{ URL::asset('build/images/product/img-6.png') }}"
                                                            class="img-fluid d-block" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="swiper-slide rounded">
                                                <div class="p-3">
                                                    <div class="product-img bg-light rounded p-3">
                                                        <img src="{{ URL::asset('build/images/product/img-5.png') }}"
                                                            class="img-fluid d-block" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-none d-md-block">
                                            <div class="swiper-button-next"></div>
                                            <div class="swiper-button-prev"></div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <div thumbsSlider="" class="swiper product-nav-slider mt-2 overflow-hidden">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide rounded">
                                                    <div class="nav-slide-item"><img src="{{ URL::asset('build/images/product/img-1.png') }}"
                                                            class="img-fluid p-1 d-block rounded" /></div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="nav-slide-item"><img src="{{ URL::asset('build/images/product/img-2.png') }}"
                                                            class="img-fluid p-1 d-block rounded" /></div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="nav-slide-item"><img src="{{ URL::asset('build/images/product/img-3.png') }}"
                                                            class="img-fluid p-1 d-block rounded" /></div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="nav-slide-item"><img src="{{ URL::asset('build/images/product/img-6.png') }}"
                                                            class="img-fluid p-1 d-block rounded" /></div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="nav-slide-item"><img src="{{ URL::asset('build/images/product/img-5.png') }}"
                                                            class="img-fluid p-1 d-block rounded" /></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="mt-3 mt-xl-3 ps-xl-5">
                                    <h4 class="font-size-20 mb-3"><a href="" class="text-body">Home & Office Chair
                                            Crime</a></h4>

                                    <p class="text-muted mb-0">
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star-half text-warning"></i>
                                    </p>

                                    <div class="text-muted mt-2">
                                        <span class="badge bg-success font-size-14 me-1"><i class="mdi mdi-star"></i>
                                            4.5</span> 234 Reviews
                                    </div>

                                    <h2 class="text-primary mt-4 py-2 mb-0">$460 <del
                                            class="text-muted font-size-18 fw-medium ps-1">$520</del>

                                        <span class="badge bg-danger font-size-10 ms-1">20 % Off</span>
                                    </h2>


                                    <div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mt-3">
                                                    <h5 class="font-size-14">Specification :</h5>
                                                    <ul class="list-unstyled ps-0 mb-0 mt-3">
                                                        <li>
                                                            <p class="text-muted mb-1 text-truncate"><i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                Full heighted Hydraulic</p>
                                                        </li>
                                                        <li>
                                                            <p class="text-muted mb-1 text-truncate"><i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                Heavy Dencity Premium Cushion</p>
                                                        </li>
                                                        <li>
                                                            <p class="text-muted mb-1 text-truncate"><i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                Colour According To Salon Interior</p>
                                                        </li>
                                                        <li>
                                                            <p class="text-muted mb-1 text-truncate"><i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                1 Year Gurantee On All Parts</p>
                                                        </li>
                                                        <li>
                                                            <p class="text-muted mb-0 text-truncate"><i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                Size 25inch x 25inch</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mt-3">
                                                    <h5 class="font-size-14">Services :</h5>
                                                    <ul class="list-unstyled ps-0 mb-0 mt-3">
                                                        <li>
                                                            <p class="text-muted mb-1 text-truncate"><i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                10 Days Replacement </p>
                                                        </li>
                                                        <li>
                                                            <p class="text-muted mb-0 text-truncate"><i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                Cash on Delivery available </p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="mt-3">
                                                    <h5 class="font-size-14">Delivery location :</h5>

                                                    <div class="d-inline-flex mt-2">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter Delivery pincode">
                                                            <button class="btn btn-primary" type="button">Check</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6 col-sm-8">
                                                <div class="product-desc-color mt-3">
                                                    <h5 class="font-size-14">Colors :</h5>
                                                    <ul class="list-inline mt-3">
                                                        <li class="list-inline-item">
                                                            <i class="mdi mdi-circle font-size-18 text-body"></i>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <i class="mdi mdi-circle font-size-18 text-success"></i>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <i class="mdi mdi-circle font-size-18 text-primary"></i>
                                                        </li>

                                                        <li class="list-inline-item">
                                                            <a href="#" class="text-primary border-0 p-1">
                                                                2 + Colors
                                                            </a>
                                                        </li>
                                                    </ul>

                                                </div>


                                                <div class="row text-center mt-4 pt-1">
                                                    <div class="col-sm-6">
                                                        <div class="d-grid">
                                                            <button type="button"
                                                                class="btn btn-primary waves-effect waves-light mt-2 me-1">
                                                                <i class="bx bx-cart me-2"></i> Add to cart
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="d-grid">
                                                            <button type="button"
                                                                class="btn btn-light waves-effect  mt-2 waves-light">
                                                                <i class="bx bx-shopping-bag me-2"></i>Buy now
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="font-size-14 mb-3">Product Track : </h5>
                            </div>

                            <div class="row">
                                <div class="col-xl-3 col-lg-6">
                                    <div class="border p-4 rounded mt-4 mt-lg-0">
                                        <i class="bx bxs-truck h2 text-primary mb-0"></i>
                                        <h5 class="font-size-17 mb-0 mt-3">Fast Delivery</h5>
                                        <p class="text-muted mb-0 pt-2">Passages and more recently with desktop publishing
                                            software like Aldus PageMaker including versions.</p>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-6">
                                    <div class="border p-4 rounded mt-4 mt-lg-0">
                                        <i class="bx bx-rotate-right h2 text-primary mb-0"></i>
                                        <h5 class="font-size-17 mb-0 mt-3">Returns in 7 Days</h5>
                                        <p class="text-muted mb-0 pt-2">Principle of selection: he rejects pleasures to
                                            secure other greater pleasures or else endures pains worse pains."</p>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-6">
                                    <div class="border p-4 rounded mt-4 mt-lg-0">
                                        <i class="bx bx-support h2 text-primary mb-0"></i>
                                        <h5 class="font-size-17 mb-0 mt-3">Online Support 24/7</h5>
                                        <p class="text-muted mb-0 pt-2">Itaque earum rerum hic tenetur a sapiente delectus
                                            ut aut reiciendis volupta maiores alias consequatur aut perferendis.</p>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-6">
                                    <div class="border p-4 rounded mt-4 mt-lg-0">
                                        <i class="bx bxs-wallet-alt h2 text-primary mb-0"></i>
                                        <h5 class="font-size-17 mb-0 mt-3">Secure Payment</h5>
                                        <p class="text-muted mb-0 pt-2">Welcomed and every pain avoided certain
                                            circumstances and owing to the business it will frequently occur that.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="">
                                    <h5 class="font-size-14 mb-3">Reviews : </h5>
                                    <div class="text-muted mb-3">
                                        <span class="badge bg-success font-size-14 me-1"><i class="mdi mdi-star"></i>
                                            4.2</span> 234 Reviews
                                    </div>

                                    <div class="border py-4 rounded">

                                        <div class="px-4" data-simplebar style="max-height: 360px;">
                                            <div class="border-bottom pb-3">
                                                <p class="float-sm-end text-muted font-size-13">12 July, 2021</p>
                                                <div class="badge bg-success mb-2"><i class="mdi mdi-star"></i> 4.1</div>
                                                <p class="text-muted mb-4">Maecenas non vestibulum ante, nec efficitur
                                                    orci. Duis eu ornare mi, quis bibendum quam. Etiam imperdiet aliquam
                                                    purus sit amet rhoncus. Vestibulum pretium consectetur leo, in mattis
                                                    ipsum sollicitudin eget. Pellentesque vel mi tortor.
                                                    Nullam vitae maximus dui dolor sit amet, consectetur adipiscing elit.
                                                </p>
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex">
                                                            <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                class="avatar-sm rounded-circle" alt="">
                                                            <div class="flex-1 ms-2 ps-1">
                                                                <h5 class="font-size-16 mb-0">Samuel</h5>
                                                                <p class="text-muted mb-0 mt-1">65 Followers, 86 Reviews
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="flex-shrink-0">
                                                        <ul class="list-inline product-review-link mb-0">
                                                            <li class="list-inline-item">
                                                                <a href="#"><i class="bx bx-like"></i></a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <a href="#"><i class="bx bx-comment-dots"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="border-bottom py-3">
                                                <p class="float-sm-end text-muted font-size-13">06 July, 2021</p>
                                                <div class="badge bg-success mb-2"><i class="mdi mdi-star"></i> 4.0</div>
                                                <p class="text-muted mb-4">Cras ac condimentum velit. Quisque vitae elit
                                                    auctor quam egestas congue. Duis eget lorem fringilla, ultrices justo
                                                    consequat, gravida lorem. Maecenas orci enim, sodales id condimentum et,
                                                    nisl arcu aliquam velit,
                                                    sit amet vehicula turpis metus cursus dolor cursus eget dui.</p>
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex">
                                                            <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                                                class="avatar-sm rounded-circle" alt="">
                                                            <div class="flex-1 ms-2 ps-1">
                                                                <h5 class="font-size-16 mb-0">Joseph</h5>
                                                                <p class="text-muted mb-0 mt-1">85 Followers, 102 Reviews
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="flex-shrink-0">
                                                        <ul class="list-inline product-review-link mb-0">
                                                            <li class="list-inline-item">
                                                                <a href="#"><i class="bx bx-like"></i></a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <a href="#"><i class="bx bx-comment-dots"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pt-3">
                                                <p class="float-sm-end text-muted font-size-13">26 June, 2021</p>
                                                <div class="badge bg-success mb-2"><i class="mdi mdi-star"></i> 4.2</div>
                                                <p class="text-muted mb-4">Aliquam sit amet eros eleifend, tristique ante
                                                    sit amet, eleifend arcu. Cras ut diam quam. Fusce quis diam eu augue
                                                    semper ullamcorper vitae sed massa. Mauris lacinia, massa a feugiat
                                                    mattis, leo massa porta eros, sed congue arcu sem nec orci.
                                                    In ac consectetur augue. Nullam pulvinar risus non augue tincidunt
                                                    blandit.</p>
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex">
                                                            <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}"
                                                                class="avatar-sm rounded-circle" alt="">
                                                            <div class="flex-1 ms-2 ps-1">
                                                                <h5 class="font-size-16 mb-0">Paul</h5>
                                                                <p class="text-muted mb-0 mt-1">27 Followers, 66 Reviews
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="flex-shrink-0">
                                                        <ul class="list-inline product-review-link mb-0">
                                                            <li class="list-inline-item">
                                                                <a href="#"><i class="bx bx-like"></i></a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <a href="#"><i class="bx bx-comment-dots"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="px-4 mt-2">
                                            <div class="border rounded mt-4">
                                                <form action="#">
                                                    <div class="px-2 py-1 bg-light">
                                                        <div class="btn-group" role="group">
                                                            <button type="button"
                                                                class="btn btn-sm btn-link text-body text-decoration-none"><i
                                                                    class="bx bx-link"></i></button>
                                                            <button type="button"
                                                                class="btn btn-sm btn-link text-body text-decoration-none"><i
                                                                    class="bx bx-smile"></i></button>
                                                            <button type="button"
                                                                class="btn btn-sm btn-link text-body text-decoration-none"><i
                                                                    class="bx bx-at"></i></button>
                                                        </div>
                                                    </div>
                                                    <textarea rows="3" class="form-control border-0 resize-none" placeholder="Your Message..."></textarea>
                                                </form>
                                            </div>

                                            <div class="text-end mt-3">
                                                <button type="button" class="btn btn-success w-sm text-truncate ms-2">
                                                    Send <i class="bx bx-send ms-2 align-middle"></i></button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="product-desc">
                                    <h5 class="font-size-14 mb-3">Product description : </h5>
                                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" id="desc-tab" data-bs-toggle="tab" href="#desc"
                                                role="tab">Description</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" id="specifi-tab" data-bs-toggle="tab"
                                                href="#specifi" role="tab">Specifications</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content border border-top-0 p-4">
                                        <div class="tab-pane fade" id="desc" role="tabpanel">
                                            <div class="row">
                                                <div class="col-sm-3 col-md-3">
                                                    <div>
                                                        <img src="{{ URL::asset('build/images/product/img.png') }}" alt=""
                                                            class="img-fluid mx-auto rounded d-block">
                                                    </div>
                                                </div>
                                                <div class="col-sm-9 col-md-9">
                                                    <div class="text-muted p-2">
                                                        <p>If several languages coalesce, the grammar of the resulting
                                                            language is more simple.</p>

                                                        <p>It will be as simple as occidental in fact.</p>

                                                        <div>
                                                            <ul class="list-unstyled product-desc-list text-body mb-0">
                                                                <li><i
                                                                        class="mdi mdi-circle-medium me-1 align-middle text-primary"></i>
                                                                    Sed ut perspiciatis omnis iste</li>
                                                                <li><i
                                                                        class="mdi mdi-circle-medium me-1 align-middle text-primary"></i>
                                                                    Neque porro quisquam est</li>
                                                                <li><i
                                                                        class="mdi mdi-circle-medium me-1 align-middle text-primary"></i>
                                                                    Quis autem vel eum iure</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade show active" id="specifi" role="tabpanel">
                                            <div class="table-responsive">
                                                <table class="table table-nowrap mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row" style="width: 50%;">Category :</th>
                                                            <td> Chairs </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Brand :</th>
                                                            <td>Bajaj</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Color :</th>
                                                            <td>body</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Quality :</th>
                                                            <td>High</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Material :</th>
                                                            <td>Metal</td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
        <!-- swiper js -->
        <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/ecommerce-product-detail.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
