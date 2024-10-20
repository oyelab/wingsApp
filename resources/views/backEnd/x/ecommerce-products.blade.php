@extends('backEnd.layouts.master')
@section('title')
    Products
@endsection
@section('css')
    <!-- swiper css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}">

    <!-- nouisliderribute css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/nouislider/nouislider.min.css') }}">
@endsection
@section('page-title')
    Products
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-header bg-transparent border-bottom">
                        <h5 class="mb-0">Filters</h5>
                    </div>

                    <div>
                        <div class="custom-accordion p-4">
                            <h5 class="font-size-14 mb-0"><a href="#categories-collapse" class="text-body d-block"
                                    data-bs-toggle="collapse">Categories <i
                                        class="mdi mdi-chevron-up float-end accor-down-icon"></i></a></h5>

                            <div class="collapse show mt-4" id="categories-collapse">
                                <div class="categories-group-card">
                                    <a href="#collapseOne" class="text-body fw-semibold pb-3 d-block collapsed"
                                        data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                                        <i class="bx bx-desktop font-size-16 align-middle me-2"></i>
                                        Electronic
                                        <i class="mdi mdi-chevron-up float-end accor-down-icon"></i>
                                    </a>

                                    <div id="collapseOne" class="collapse" data-parent="#accordion">
                                        <div class="card p-2 border shadow-none">
                                            <ul class="list-unstyled categories-list mb-0">
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>
                                                        Mobile</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>
                                                        Cemera</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Mobile
                                                        accessories</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>
                                                        Computers</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>
                                                        Laptops</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>
                                                        Speakers</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="categories-group-card">
                                    <a href="#collapseTwo" class="text-body fw-semibold pb-3 d-block"
                                        data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseTwo">
                                        <i class="bx bx-radar font-size-16 align-middle me-2"></i> Furniture
                                        <i class="mdi mdi-chevron-up float-end accor-down-icon"></i>
                                    </a>
                                    <div id="collapseTwo" class="collapse show" data-parent="#accordion">
                                        <div class="card p-2 border shadow-none">
                                            <ul class="list-unstyled categories-list mb-0">
                                                <li class="active"><a href="#"><i
                                                            class="mdi mdi-circle-medium me-1"></i> Chairs
                                                    </a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>
                                                        Tables</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Beds
                                                    </a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>
                                                        Seating</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="categories-group-card">
                                    <a href="#collapseThree" class="text-body fw-semibold pb-3 d-block collapsed"
                                        data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseThree">
                                        <i class="bx bx-command font-size-16 align-middle me-2"></i> Baby &
                                        Kids
                                        <i class="mdi mdi-chevron-up float-end accor-down-icon"></i>
                                    </a>
                                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                                        <div class="card p-2 border shadow-none">
                                            <ul class="list-unstyled categories-list mb-0">
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>
                                                        Clothing</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>
                                                        Footwear</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Toys</a>
                                                </li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Baby
                                                        care</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="categories-group-card">
                                    <a href="#collapseFour" class="text-body fw-semibold pb-3 d-block collapsed"
                                        data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseFour">
                                        <i class="bx bx-dumbbell font-size-16 align-middle me-2"></i>
                                        Fitness
                                        <i class="mdi mdi-chevron-up float-end accor-down-icon"></i>
                                    </a>
                                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                                        <div class="card p-2 border shadow-none">
                                            <ul class="list-unstyled categories-list mb-0">
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Gym
                                                        equipment</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Yoga
                                                        mat</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>
                                                        Dumbbells</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Protein
                                                        supplements</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="p-4 border-top">
                            <div>
                                <h5 class="font-size-14 mb-3">Price</h5>
                                <div id="priceslider" class="mb-4"></div>
                            </div>
                        </div>

                        <div class="custom-accordion">
                            <div class="p-4 border-top">
                                <div>
                                    <h5 class="font-size-14 mb-0"><a href="#filtersizes-collapse"
                                            class="text-body d-block" data-bs-toggle="collapse">Sizes <i
                                                class="mdi mdi-chevron-up float-end accor-down-icon"></i></a>
                                    </h5>

                                    <div class="collapse show" id="filtersizes-collapse">
                                        <div class="mt-4">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="font-size-15 mb-0">Select Sizes</h5>
                                                </div>
                                                <div class="w-xs">
                                                    <select class="form-select">
                                                        <option value="1">3</option>
                                                        <option value="2">4</option>
                                                        <option value="3">5</option>
                                                        <option value="4">6</option>
                                                        <option value="5" selected>7</option>
                                                        <option value="6">8</option>
                                                        <option value="7">9</option>
                                                        <option value="8">10</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="p-4 border-top">
                                <div>
                                    <h5 class="font-size-14 mb-0"><a href="#filterprodductcolor-collapse"
                                            class="text-body d-block" data-bs-toggle="collapse">Colors <i
                                                class="mdi mdi-chevron-up float-end accor-down-icon"></i></a>
                                    </h5>

                                    <div class="collapse show" id="filterprodductcolor-collapse">
                                        <div class="mt-4">
                                            <div class="form-check mt-2">
                                                <input type="checkbox" class="form-check-input" id="productcolorCheck1">
                                                <label class="form-check-label" for="productcolorCheck1"><i
                                                        class="mdi mdi-circle text-body mx-1"></i>
                                                    Black</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input type="checkbox" class="form-check-input" id="productcolorCheck2">
                                                <label class="form-check-label" for="productcolorCheck2"><i
                                                        class="mdi mdi-circle text-light mx-1"></i>
                                                    White</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input type="checkbox" class="form-check-input" id="productcolorCheck3">
                                                <label class="form-check-label" for="productcolorCheck3"><i
                                                        class="mdi mdi-circle text-secondary mx-1"></i>
                                                    Gray</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input type="checkbox" class="form-check-input" id="productcolorCheck4">
                                                <label class="form-check-label" for="productcolorCheck4"><i
                                                        class="mdi mdi-circle text-primary mx-1"></i>
                                                    Blue</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input type="checkbox" class="form-check-input" id="productcolorCheck5">
                                                <label class="form-check-label" for="productcolorCheck5"><i
                                                        class="mdi mdi-circle text-success mx-1"></i>
                                                    Green</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input type="checkbox" class="form-check-input" id="productcolorCheck6">
                                                <label class="form-check-label" for="productcolorCheck6"><i
                                                        class="mdi mdi-circle text-danger mx-1"></i>
                                                    Red</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input type="checkbox" class="form-check-input" id="productcolorCheck7">
                                                <label class="form-check-label" for="productcolorCheck7"><i
                                                        class="mdi mdi-circle text-warning mx-1"></i>
                                                    Yellow</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input type="checkbox" class="form-check-input" id="productcolorCheck8">
                                                <label class="form-check-label" for="productcolorCheck8"><i
                                                        class="mdi mdi-circle text-purple mx-1"></i>
                                                    Purple</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="p-4 border-top">
                                <div>
                                    <h5 class="font-size-14 mb-0"><a href="#filterproduct-color-collapse"
                                            class="text-body d-block" data-bs-toggle="collapse">Customer
                                            Rating <i class="mdi mdi-chevron-up float-end accor-down-icon"></i></a>
                                    </h5>

                                    <div class="collapse show" id="filterproduct-color-collapse">
                                        <div class="mt-4">
                                            <div class="form-check mt-2">
                                                <input type="radio" id="productratingRadio1" name="productratingRadio1"
                                                    class="form-check-input">
                                                <label class="form-check-label" for="productratingRadio1">4 <i
                                                        class="mdi mdi-star text-warning"></i> &
                                                    Above</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input type="radio" id="productratingRadio2" name="productratingRadio1"
                                                    class="form-check-input">
                                                <label class="form-check-label" for="productratingRadio2">3 <i
                                                        class="mdi mdi-star text-warning"></i> &
                                                    Above</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input type="radio" id="productratingRadio3" name="productratingRadio1"
                                                    class="form-check-input">
                                                <label class="form-check-label" for="productratingRadio3">2 <i
                                                        class="mdi mdi-star text-warning"></i> &
                                                    Above</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input type="radio" id="productratingRadio4" name="productratingRadio1"
                                                    class="form-check-input">
                                                <label class="form-check-label" for="productratingRadio4">1 <i
                                                        class="mdi mdi-star text-warning"></i></label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="p-4 border-top">
                                <div>
                                    <h5 class="font-size-14 mb-0"><a href="#filterproduct-discount-collapse"
                                            class="text-body d-block" data-bs-toggle="collapse">Discount
                                            <i class="mdi mdi-chevron-up float-end accor-down-icon"></i></a>
                                    </h5>

                                    <div class="collapse show" id="filterproduct-discount-collapse">
                                        <div class="mt-4">
                                            <div class="form-check mt-2">
                                                <input type="radio" id="productdiscountRadio1"
                                                    name="productdiscountRadio" class="form-check-input">
                                                <label class="form-check-label" for="productdiscountRadio1">50% or
                                                    more</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input type="radio" id="productdiscountRadio2"
                                                    name="productdiscountRadio" class="form-check-input">
                                                <label class="form-check-label" for="productdiscountRadio2">40% or
                                                    more</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input type="radio" id="productdiscountRadio3"
                                                    name="productdiscountRadio" class="form-check-input">
                                                <label class="form-check-label" for="productdiscountRadio3">30% or
                                                    more</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input type="radio" id="productdiscountRadio4"
                                                    name="productdiscountRadio" class="form-check-input">
                                                <label class="form-check-label" for="productdiscountRadio4">20% or
                                                    more</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input type="radio" id="productdiscountRadio5"
                                                    name="productdiscountRadio" class="form-check-input">
                                                <label class="form-check-label" for="productdiscountRadio5">10% or
                                                    more</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input type="radio" id="productdiscountRadio6"
                                                    name="productdiscountRadio" class="form-check-input">
                                                <label class="form-check-label" for="productdiscountRadio6">Less than
                                                    10%</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="swiper-container slider rounded overflow-hidden">
                            <div class="swiper-wrapper" dir="ltr">
                                <div class="swiper-slide rounded overflow-hidden ecommerce-slied-bg">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-11 col-lg-11">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <div class="p-4 p-xl-0">
                                                        <img src="{{ URL::asset('build/images/product/img-8.png') }}"
                                                            class="img-fluid" alt="">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="p-4 p-xl-0">
                                                        <h3 class="mb-2 text-truncate"><a
                                                                href="ecommerce-product-detail">Tuition
                                                                Classes Chair Crime </a></h3>
                                                        <h5 class="fw-normal font-size-16 mt-1 text-truncate">
                                                            SKU: Fluid HB - Lite - AN White</h5>
                                                        <ul class="list-unstyled px-0 mb-0 mt-4">
                                                            <li>
                                                                <p class="text-muted mb-1 text-truncate"><i
                                                                        class="mdi mdi-circle-medium align-middle me-1"></i>
                                                                    3 Year Warranty and Stock Available</p>
                                                            </li>
                                                            <li>
                                                                <p class="text-muted mb-1 text-truncate"><i
                                                                        class="mdi mdi-circle-medium align-middle me-1"></i>
                                                                    Material : Steel + PVC Leather + Sponge
                                                                </p>
                                                            </li>
                                                        </ul>
                                                        <h2 class="mb-0 mt-4 text-truncate"><span
                                                                class="font-size-20">Form</span><b>
                                                                $2,360</b> <span class="text-muted me-2"><del
                                                                    class="font-size-20 fw-normal">$3500</del></span>
                                                        </h2>
                                                        <div class="mt-4">
                                                            <button type="button"
                                                                class="btn btn-success w-lg waves-effect waves-light">Buy
                                                                Now</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide rounded overflow-hidden ecommerce-slied-bg">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-11 col-lg-11">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <div class="p-4 p-xl-0">
                                                        <img src="{{ URL::asset('build/images/product/img-4.png') }}"
                                                            class="img-fluid" alt="">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="p-4 p-xl-0">
                                                        <h3 class="mb-2 text-truncate"><a
                                                                href="ecommerce-product-detail">Home &
                                                                Office Chair Crime </a></h3>
                                                        <h5 class="fw-normal font-size-16 mt-1 text-truncate">
                                                            SKU: Fluid HB - Lite - AN Grey</h5>

                                                        <ul class="list-unstyled px-0 mb-0 mt-4">
                                                            <li>
                                                                <p class="text-muted mb-1 text-truncate"><i
                                                                        class="mdi mdi-circle-medium align-middle me-1"></i>
                                                                    Material : Steel + PVC Leather + Sponge
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p class="text-muted mb-1 text-truncate"><i
                                                                        class="mdi mdi-circle-medium align-middle me-1"></i>
                                                                    Overall Dimention : 16.5" x 19.5" x
                                                                    24.3" (L x W x H)</p>
                                                            </li>
                                                        </ul>

                                                        <h2 class="mb-0 mt-4 text-truncate"><span
                                                                class="font-size-20">Form</span><b>
                                                                $2,360</b> <span class="text-muted me-2"><del
                                                                    class="font-size-20 fw-normal">$3500</del></span>
                                                        </h2>
                                                        <div class="mt-4">
                                                            <button type="button"
                                                                class="btn btn-success w-lg waves-effect waves-light">Buy
                                                                Now</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide rounded overflow-hidden ecommerce-slied-bg">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-11 col-lg-11">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <div class="p-4 p-xl-0">
                                                        <img src="{{ URL::asset('build/images/product/img-6.png') }}"
                                                            class="img-fluid" alt="">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="p-4 p-xl-0">
                                                        <h3 class="mb-2 text-truncate"><a
                                                                href="ecommerce-product-detail">Hotel
                                                                Dining Table And Chair</a></h3>
                                                        <h5 class="fw-normal font-size-16 mt-1 text-truncate">
                                                            SKU: Fluid HB - Lite - AN body</h5>
                                                        <ul class="list-unstyled px-0 mb-0 mt-4">
                                                            <li>
                                                                <p class="text-muted mb-1 text-truncate"><i
                                                                        class="mdi mdi-circle-medium align-middle me-1"></i>
                                                                    Choose From Standard , Express Or
                                                                    Assembled Services</p>
                                                            </li>
                                                            <li>
                                                                <p class="text-muted mb-1 text-truncate"><i
                                                                        class="mdi mdi-circle-medium align-middle me-1"></i>
                                                                    3 Year Warranty and Stock Available</p>
                                                            </li>
                                                        </ul>
                                                        <h2 class="mb-0 mt-4 text-truncate"><span
                                                                class="font-size-20">Form</span><b>
                                                                $2,360</b> <span class="text-muted me-2"><del
                                                                    class="font-size-20 fw-normal">$3500</del></span>
                                                        </h2>
                                                        <div class="mt-4">
                                                            <button type="button"
                                                                class="btn btn-success w-lg waves-effect waves-light">Buy
                                                                Now</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-none d-lg-block">
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div>
                                        <h5>Showing result for "Chairs"</h5>
                                        <ol class="breadcrumb p-0 bg-transparent mb-2">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Furniture</a></li>
                                            <li class="breadcrumb-item active">Chairs</li>
                                        </ol>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-inline float-md-end">
                                        <div class="search-box ms-2">
                                            <div class="position-relative">
                                                <input type="text" class="form-control bg-light border-light rounded"
                                                    placeholder="Search...">
                                                <i class="bx bx-search search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <ul class="nav nav-tabs nav-tabs-custom mt-3 mb-2 ecommerce-sortby-list">
                                <li class="nav-item">
                                    <a class="nav-link disabled fw-medium" href="#" tabindex="-1"
                                        aria-disabled="true">Sort by:</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#popularity" role="tab"
                                        href="#">Popularity</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#newest" role="tab"
                                        href="#">Newest</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#discount" role="tab"
                                        href="#">Discount</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="popularity" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box rounded p-3 mt-4">
                                                <div class="pricing-badge">
                                                    <span class="badge">New</span>
                                                </div>
                                                <div class="product-img bg-light p-3 rounded">
                                                    <img src="{{ URL::asset('build/images/product/img-1.png') }}"
                                                        alt="" class="img-fluid mx-auto d-block">
                                                </div>
                                                <div class="product-content pt-3">
                                                    <p class="text-muted font-size-13 mb-0">Gray, Chair</p>
                                                    <h5 class="mt-1 mb-0"><a href="#"
                                                            class="text-body font-size-16">Home & Office
                                                            Chair Crime</a></h5>
                                                    <p class="text-muted mb-0">
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star-half text-warning font-size-12"></i>
                                                    </p>
                                                    <a href="" class="product-buy-icon bg-primary"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Add To Cart">
                                                        <i class="mdi mdi-cart-outline text-white font-size-16"></i>
                                                    </a>
                                                    <h5 class="font-size-20 text-primary mt-3 mb-0">$260
                                                        <del class="text-muted font-size-15 fw-medium ps-1">$280</del>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box rounded p-3 mt-4">
                                                <div class="product-img bg-light p-3 rounded">
                                                    <img src="{{ URL::asset('build/images/product/img-2.png') }}"
                                                        alt="" class="img-fluid mx-auto d-block">
                                                </div>
                                                <div class="product-content pt-3">
                                                    <p class="text-muted font-size-13 mb-0">Black, Chair
                                                    </p>
                                                    <h5 class="mt-1 mb-0"><a href="#"
                                                            class="text-body font-size-16">Sofa Home Chair
                                                            Black</a></h5>
                                                    <p class="text-muted mb-0">
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                    </p>
                                                    <a href="" class="product-buy-icon bg-primary"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Add To Cart">
                                                        <i class="mdi mdi-cart-outline text-white font-size-16"></i>
                                                    </a>
                                                    <h5 class="font-size-20 text-primary mt-3 mb-0">$180
                                                        <del class="text-muted font-size-15 fw-medium ps-1">$200</del>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box rounded p-3 mt-4">
                                                <div class="pricing-badge">
                                                    <span class="badge bg-danger">- 20 %</span>
                                                </div>
                                                <div class="product-img bg-light p-3 rounded">
                                                    <img src="{{ URL::asset('build/images/product/img-3.png') }}"
                                                        alt="" class="img-fluid mx-auto d-block">
                                                </div>
                                                <div class="product-content pt-3">
                                                    <p class="text-muted font-size-13 mb-0">Chair</p>
                                                    <h5 class="mt-1 mb-0"><a href="#"
                                                            class="text-body font-size-16">Tuition Classes
                                                            Chair Crime</a></h5>
                                                    <p class="text-muted mb-0">
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                    </p>
                                                    <a href="" class="product-buy-icon bg-primary"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Add To Cart">
                                                        <i class="mdi mdi-cart-outline text-white font-size-16"></i>
                                                    </a>
                                                    <h5 class="font-size-20 text-primary mt-3 mb-0">$410
                                                        <del class="text-muted font-size-15 fw-medium ps-1">$340</del>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box rounded p-3 mt-4">
                                                <div class="product-img bg-light p-3 rounded">
                                                    <img src="{{ URL::asset('build/images/product/img-4.png') }}"
                                                        alt="" class="img-fluid mx-auto d-block">
                                                </div>
                                                <div class="product-content pt-3">
                                                    <p class="text-muted font-size-13 mb-0">Gray, Chair</p>
                                                    <h5 class="mt-1 mb-0"><a href="#"
                                                            class="text-body font-size-16">Dining Table And
                                                            Chair</a></h5>
                                                    <p class="text-muted mb-0">
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star-half text-warning font-size-12"></i>
                                                    </p>
                                                    <a href="" class="product-buy-icon bg-primary"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Add To Cart">
                                                        <i class="mdi mdi-cart-outline text-white font-size-16"></i>
                                                    </a>
                                                    <h5 class="font-size-20 text-primary mt-3 mb-0">$260
                                                        <del class="text-muted font-size-15 fw-medium ps-1">$280</del>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box rounded p-3 mt-4">
                                                <div class="pricing-badge">
                                                    <span class="badge">New</span>
                                                </div>
                                                <div class="product-img bg-light p-3 rounded">
                                                    <img src="{{ URL::asset('build/images/product/img-5.png') }}"
                                                        alt="" class="img-fluid mx-auto d-block">
                                                </div>
                                                <div class="product-content pt-3">
                                                    <p class="text-muted font-size-13 mb-0">Gray, Chair</p>
                                                    <h5 class="mt-1 mb-0"><a href="#"
                                                            class="text-body font-size-16">Home & Office
                                                            Chair Crime</a></h5>
                                                    <p class="text-muted mb-0">
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star-half text-warning font-size-12"></i>
                                                    </p>
                                                    <a href="" class="product-buy-icon bg-primary"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Add To Cart">
                                                        <i class="mdi mdi-cart-outline text-white font-size-16"></i>
                                                    </a>
                                                    <h5 class="font-size-20 text-primary mt-3 mb-0">$260
                                                        <del class="text-muted font-size-15 fw-medium ps-1">$280</del>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box rounded p-3 mt-4">
                                                <div class="product-img bg-light p-3 rounded">
                                                    <img src="{{ URL::asset('build/images/product/img-6.png') }}"
                                                        alt="" class="img-fluid mx-auto d-block">
                                                </div>
                                                <div class="product-content pt-3">
                                                    <p class="text-muted font-size-13 mb-0">Gray, Chair</p>
                                                    <h5 class="mt-1 mb-0"><a href="#"
                                                            class="text-body font-size-16">Home & Office
                                                            Chair Crime</a></h5>
                                                    <p class="text-muted mb-0">
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star-half text-warning font-size-12"></i>
                                                    </p>
                                                    <a href="" class="product-buy-icon bg-primary"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Add To Cart">
                                                        <i class="mdi mdi-cart-outline text-white font-size-16"></i>
                                                    </a>
                                                    <h5 class="font-size-20 text-primary mt-3 mb-0">$260
                                                        <del class="text-muted font-size-15 fw-medium ps-1">$280</del>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->
                                </div>

                                <div class="tab-pane" id="newest" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box rounded p-3 mt-4">
                                                <div class="pricing-badge">
                                                    <span class="badge">New</span>
                                                </div>
                                                <div class="product-img bg-light p-3 rounded">
                                                    <img src="{{ URL::asset('build/images/product/img-7.png') }}"
                                                        alt="" class="img-fluid mx-auto d-block">
                                                </div>
                                                <div class="product-content pt-3">
                                                    <p class="text-muted font-size-13 mb-0">Chair</p>
                                                    <h5 class="mt-1 mb-0"><a href="#"
                                                            class="text-body font-size-16">Tuition Classes
                                                            Chair Crime</a></h5>
                                                    <p class="text-muted mb-0">
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                    </p>
                                                    <a href="" class="product-buy-icon bg-primary"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Add To Cart">
                                                        <i class="mdi mdi-cart-outline text-white font-size-16"></i>
                                                    </a>
                                                    <h5 class="font-size-20 text-primary mt-3 mb-0">$410
                                                        <del class="text-muted font-size-15 fw-medium ps-1">$340</del>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box rounded p-3 mt-4">
                                                <div class="pricing-badge">
                                                    <span class="badge">New</span>
                                                </div>
                                                <div class="product-img bg-light p-3 rounded">
                                                    <img src="{{ URL::asset('build/images/product/img-8.png') }}"
                                                        alt="" class="img-fluid mx-auto d-block">
                                                </div>
                                                <div class="product-content pt-3">
                                                    <p class="text-muted font-size-13 mb-0">Gray, Chair</p>
                                                    <h5 class="mt-1 mb-0"><a href="#"
                                                            class="text-body font-size-16">Dining Table And
                                                            Chair</a></h5>
                                                    <p class="text-muted mb-0">
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star-half text-warning font-size-12"></i>
                                                    </p>
                                                    <a href="" class="product-buy-icon bg-primary"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Add To Cart">
                                                        <i class="mdi mdi-cart-outline text-white font-size-16"></i>
                                                    </a>
                                                    <h5 class="font-size-20 text-primary mt-3 mb-0">$260
                                                        <del class="text-muted font-size-15 fw-medium ps-1">$280</del>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box rounded p-3 mt-4">
                                                <div class="pricing-badge">
                                                    <span class="badge">New</span>
                                                </div>
                                                <div class="pricing-badge">
                                                    <span class="badge">New</span>
                                                </div>
                                                <div class="product-img bg-light p-3 rounded">
                                                    <img src="{{ URL::asset('build/images/product/img-9.png') }}"
                                                        alt="" class="img-fluid mx-auto d-block">
                                                </div>
                                                <div class="product-content pt-3">
                                                    <p class="text-muted font-size-13 mb-0">Gray, Chair</p>
                                                    <h5 class="mt-1 mb-0"><a href="#"
                                                            class="text-body font-size-16">Home & Office
                                                            Chair Crime</a></h5>
                                                    <p class="text-muted mb-0">
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star-half text-warning font-size-12"></i>
                                                    </p>
                                                    <a href="" class="product-buy-icon bg-primary"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Add To Cart">
                                                        <i class="mdi mdi-cart-outline text-white font-size-16"></i>
                                                    </a>
                                                    <h5 class="font-size-20 text-primary mt-3 mb-0">$260
                                                        <del class="text-muted font-size-15 fw-medium ps-1">$280</del>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box rounded p-3 mt-4">
                                                <div class="pricing-badge">
                                                    <span class="badge">New</span>
                                                </div>
                                                <div class="product-img bg-light p-3 rounded">
                                                    <img src="{{ URL::asset('build/images/product/img-6.png') }}"
                                                        alt="" class="img-fluid mx-auto d-block">
                                                </div>
                                                <div class="product-content pt-3">
                                                    <p class="text-muted font-size-13 mb-0">Gray, Chair</p>
                                                    <h5 class="mt-1 mb-0"><a href="#"
                                                            class="text-body font-size-16">Home & Office
                                                            Chair Crime</a></h5>
                                                    <p class="text-muted mb-0">
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star-half text-warning font-size-12"></i>
                                                    </p>
                                                    <a href="" class="product-buy-icon bg-primary"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Add To Cart">
                                                        <i class="mdi mdi-cart-outline text-white font-size-16"></i>
                                                    </a>
                                                    <h5 class="font-size-20 text-primary mt-3 mb-0">$260
                                                        <del class="text-muted font-size-15 fw-medium ps-1">$280</del>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end row -->
                                </div>
                                <div class="tab-pane" id="discount" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box rounded p-3 mt-4">
                                                <div class="pricing-badge">
                                                    <span class="badge bg-danger"> 20 %</span>
                                                </div>
                                                <div class="product-img bg-light p-3 rounded">
                                                    <img src="{{ URL::asset('build/images/product/img-9.png') }}"
                                                        alt="" class="img-fluid mx-auto d-block">
                                                </div>
                                                <div class="product-content pt-3">
                                                    <p class="text-muted font-size-13 mb-0">Gray, Chair</p>
                                                    <h5 class="mt-1 mb-0"><a href="#"
                                                            class="text-body font-size-16">Home & Office
                                                            Chair Crime</a></h5>
                                                    <p class="text-muted mb-0">
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star-half text-warning font-size-12"></i>
                                                    </p>
                                                    <a href="" class="product-buy-icon bg-primary"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Add To Cart">
                                                        <i class="mdi mdi-cart-outline text-white font-size-16"></i>
                                                    </a>
                                                    <h5 class="font-size-20 text-primary mt-3 mb-0">$260
                                                        <del class="text-muted font-size-15 fw-medium ps-1">$280</del>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box rounded p-3 mt-4">
                                                <div class="pricing-badge">
                                                    <span class="badge bg-danger"> 20 %</span>
                                                </div>
                                                <div class="product-img bg-light p-3 rounded">
                                                    <img src="{{ URL::asset('build/images/product/img-6.png') }}"
                                                        alt="" class="img-fluid mx-auto d-block">
                                                </div>
                                                <div class="product-content pt-3">
                                                    <p class="text-muted font-size-13 mb-0">Black, Chair
                                                    </p>
                                                    <h5 class="mt-1 mb-0"><a href="#"
                                                            class="text-body font-size-16">Sofa Home Chair
                                                            Black</a></h5>
                                                    <p class="text-muted mb-0">
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                    </p>
                                                    <a href="" class="product-buy-icon bg-primary"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Add To Cart">
                                                        <i class="mdi mdi-cart-outline text-white font-size-16"></i>
                                                    </a>
                                                    <h5 class="font-size-20 text-primary mt-3 mb-0">$180
                                                        <del class="text-muted font-size-15 fw-medium ps-1">$200</del>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box rounded p-3 mt-4">
                                                <div class="pricing-badge">
                                                    <span class="badge bg-danger"> 20 %</span>
                                                </div>
                                                <div class="product-img bg-light p-3 rounded">
                                                    <img src="{{ URL::asset('build/images/product/img-5.png') }}"
                                                        alt="" class="img-fluid mx-auto d-block">
                                                </div>
                                                <div class="product-content pt-3">
                                                    <p class="text-muted font-size-13 mb-0">Chair</p>
                                                    <h5 class="mt-1 mb-0"><a href="#"
                                                            class="text-body font-size-16">Tuition Classes
                                                            Chair Crime</a></h5>
                                                    <p class="text-muted mb-0">
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                        <i class="bx bxs-star text-warning font-size-12"></i>
                                                    </p>
                                                    <a href="" class="product-buy-icon bg-primary"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Add To Cart">
                                                        <i class="mdi mdi-cart-outline text-white font-size-16"></i>
                                                    </a>
                                                    <h5 class="font-size-20 text-primary mt-3 mb-0">$410
                                                        <del class="text-muted font-size-15 fw-medium ps-1">$340</del>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <div>
                                        <p class="mb-sm-0">Page 2 of 84</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-sm-end">
                                        <ul class="pagination pagination-rounded mb-sm-0">
                                            <li class="page-item disabled">
                                                <a href="#" class="page-link"><i
                                                        class="mdi mdi-chevron-left"></i></a>
                                            </li>
                                            <li class="page-item active">
                                                <a href="#" class="page-link">1</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">2</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">3</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">4</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">5</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link"><i
                                                        class="mdi mdi-chevron-right"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <!-- swiper js -->
        <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

        <!-- nouisliderribute js -->
        <script src="{{ URL::asset('build/libs/nouislider/nouislider.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/wnumb/wNumb.min.js') }}"></script>

        <!-- init js -->
        <script src="{{ URL::asset('build/js/pages/product-filter-range.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
