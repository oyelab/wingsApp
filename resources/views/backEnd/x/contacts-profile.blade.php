@extends('backEnd.layouts.master')
@section('title')
    Profile
@endsection
@section('page-title')
    Profile
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xxl-3">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="user-profile-img">
                            <img src="{{ URL::asset('build/images/pattern-bg.jpg') }}" class="profile-img profile-foreground-img rounded-top"
                                style="height: 120px;" alt="">
                            <div class="overlay-content rounded-top">
                                <div>
                                    <div class="user-nav p-3">
                                        <div class="d-flex justify-content-end">
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-16" href="#"
                                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="bx bx-dots-vertical text-white font-size-20"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end user-profile-img -->


                        <div class="p-4 pt-0">

                            <div class="mt-n5 position-relative text-center border-bottom pb-3">
                                <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt=""
                                    class="avatar-xl rounded-circle img-thumbnail">

                                <div class="mt-3">
                                    <h5 class="mb-1">Martin Gurley</h5>
                                    <p class="text-muted mb-0">
                                        <i class="bx bxs-star text-warning font-size-14"></i>
                                        <i class="bx bxs-star text-warning font-size-14"></i>
                                        <i class="bx bxs-star text-warning font-size-14"></i>
                                        <i class="bx bxs-star text-warning font-size-14"></i>
                                        <i class="bx bxs-star-half text-warning font-size-14"></i>
                                    </p>
                                </div>

                            </div>

                            <div class="table-responsive mt-3 border-bottom pb-3">
                                <table
                                    class="table align-middle table-sm table-nowrap table-borderless table-centered mb-0">
                                    <tbody>
                                        <tr>
                                            <th class="fw-bold">
                                                City :</th>
                                            <td class="text-muted">New Your City</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th class="fw-bold">
                                                State :</th>
                                            <td class="text-muted">New Your</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th class="fw-bold">
                                                Country :</th>
                                            <td class="text-muted">USA</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th class="fw-bold">Pin Code :</th>
                                            <td class="text-muted">0005485</td>
                                        </tr>
                                        <!-- end tr -->

                                        <tr>
                                            <th class="fw-bold">Phone :</th>
                                            <td class="text-muted">+214 5632564</td>
                                        </tr>
                                        <!-- end tr -->

                                        <tr>
                                            <th class="fw-bold">Email :</th>
                                            <td class="text-muted">martingurley52@gmail.com</td>
                                        </tr>
                                        <!-- end tr -->
                                    </tbody><!-- end tbody -->
                                </table>
                            </div>



                            <div class="p-3 mt-3">
                                <div class="row text-center">
                                    <div class="col-6 border-end">
                                        <div class="p-1">
                                            <h5 class="mb-1">1,269</h5>
                                            <p class="text-muted mb-0">Products</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-1">
                                            <h5 class="mb-1">5.2k</h5>
                                            <p class="text-muted mb-0">Followers</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-2 text-center border-bottom pb-4">
                                <a href="" class="btn btn-primary waves-effect waves-light btn-sm">Send Message <i
                                        class="bx bx-send ms-1 align-middle"></i></a>
                            </div>

                            <div class="mt-3 pt-1 text-center">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <a href="javascript:void()"
                                            class="social-list-item bg-primary text-white border-primary">
                                            <i class="bx bxl-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript:void()" class="social-list-item bg-info text-white border-info">
                                            <i class="bx bxl-linkedin"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript:void()"
                                            class="social-list-item bg-danger text-white border-danger">
                                            <i class="bx bxl-google"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-9">
                <div class="card">
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#overview" role="tab">
                                    <span>Overview</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab">
                                    <span>Messages</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#post" role="tab">
                                    <span>Post</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Tab content -->
                <div class="tab-content">
                    <div class="tab-pane active" id="overview" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="font-size-16 mb-3">Summary</h5>
                                <div class="mt-3">
                                    <p class="font-size-15 mb-1">Hi my name is Jennifer Bennett.</p>
                                    <p class="font-size-15">I'm the Co-founder and Head of Design at Company agency.</p>

                                    <p class="text-muted">Been the industry's standard dummy text To an English person.
                                        Our team collaborators and clients to achieve cupidatat non proident, sunt in culpa
                                        qui officia deserunt mollit anim id est some advantage from it? But who has any
                                        right to find fault with a man who chooses to enjoy a pleasure that has no annoying
                                        consequences debitis aut rerum necessitatibus saepe eveniet ut et voluptates laborum
                                        growth.</p>

                                    <h5 class="font-size-15">Experience :</h5>
                                    <div class="row">
                                        <div class="col-4">
                                            <ul class="list-unstyled mb-0 pt-1">
                                                <li class="py-1"><i
                                                        class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Donec
                                                    vitae libero venenatis faucibus</li>
                                                <li class="py-1"><i
                                                        class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Quisque
                                                    rutrum aenean imperdiet</li>
                                                <li class="py-1"><i
                                                        class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Integer
                                                    ante a consectetuer eget</li>
                                            </ul>
                                        </div>

                                        <div class="col">
                                            <ul class="list-unstyled mb-0 pt-1">
                                                <li class="py-1"><i
                                                        class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Donec
                                                    vitae libero venenatis faucibus</li>
                                                <li class="py-1"><i
                                                        class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Quisque
                                                    rutrum aenean imperdiet</li>
                                                <li class="py-1"><i
                                                        class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Integer
                                                    ante a consectetuer eget</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <h5 class="font-size-16 mb-4">Projects</h5>
                                    <div class="table-responsive">
                                        <table class="table table-nowrap table-hover mb-1">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Projects</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Budget</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col" style="width: 120px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">01</th>
                                                    <td><a href="#" class="text-body">Brand Logo Design</a></td>
                                                    <td>
                                                        18 Jun, 2021
                                                    </td>
                                                    <td>
                                                        $523
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary-subtle text-primary font-size-12">Open</span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                                href="#" role="button" data-bs-toggle="dropdown"
                                                                aria-haspopup="true">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">02</th>
                                                    <td><a href="#" class="text-body">Chat app Design</a></td>
                                                    <td>
                                                        28 May, 2021
                                                    </td>
                                                    <td>
                                                        $356
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-success-subtle text-success font-size-12">Complete</span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                                href="#" role="button" data-bs-toggle="dropdown"
                                                                aria-haspopup="true">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">03</th>
                                                    <td><a href="#" class="text-body">Minible Landing</a></td>
                                                    <td>
                                                        13 May, 2021
                                                    </td>
                                                    <td>
                                                        $425
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-success-subtle text-success font-size-12">Complete</span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                                href="#" role="button" data-bs-toggle="dropdown"
                                                                aria-haspopup="true">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="messages" role="tabpanel">
                        <div class="card">
                            <div class="card-body">

                                <div class="py-2">

                                    <div class="mx-n4 px-4" data-simplebar style="max-height: 360px;">
                                        <div class="border-bottom pb-3">
                                            <p class="float-sm-end text-muted font-size-13">12 July, 2021</p>
                                            <div class="badge bg-success mb-2"><i class="mdi mdi-star"></i> 4.1</div>
                                            <p class="text-muted mb-4">Maecenas non vestibulum ante, nec efficitur orci.
                                                Duis eu ornare mi, quis bibendum quam. Etiam imperdiet aliquam purus sit
                                                amet rhoncus. Vestibulum pretium consectetur leo, in mattis ipsum
                                                sollicitudin eget. Pellentesque vel mi tortor.
                                                Nullam vitae maximus dui dolor sit amet, consectetur adipiscing elit.</p>
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <div class="d-flex">
                                                        <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                            class="avatar-sm rounded-circle" alt="">
                                                        <div class="flex-1 ms-2 ps-1">
                                                            <h5 class="font-size-15 mb-0">Samuel</h5>
                                                            <p class="text-muted mb-0 mt-1">65 Followers, 86 Reviews</p>
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
                                            <p class="text-muted mb-4">Cras ac condimentum velit. Quisque vitae elit auctor
                                                quam egestas congue. Duis eget lorem fringilla, ultrices justo consequat,
                                                gravida lorem. Maecenas orci enim, sodales id condimentum et, nisl arcu
                                                aliquam velit,
                                                sit amet vehicula turpis metus cursus dolor cursus eget dui.</p>
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <div class="d-flex">
                                                        <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                                            class="avatar-sm rounded-circle" alt="">
                                                        <div class="flex-1 ms-2 ps-1">
                                                            <h5 class="font-size-15 mb-0">Joseph</h5>
                                                            <p class="text-muted mb-0 mt-1">85 Followers, 102 Reviews</p>
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
                                            <p class="text-muted mb-4">Aliquam sit amet eros eleifend, tristique ante sit
                                                amet, eleifend arcu. Cras ut diam quam. Fusce quis diam eu augue semper
                                                ullamcorper vitae sed massa. Mauris lacinia, massa a feugiat mattis, leo
                                                massa porta eros, sed congue arcu sem nec orci.
                                                In ac consectetur augue. Nullam pulvinar risus non augue tincidunt blandit.
                                            </p>
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <div class="d-flex">
                                                        <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}"
                                                            class="avatar-sm rounded-circle" alt="">
                                                        <div class="flex-1 ms-2 ps-1">
                                                            <h5 class="font-size-15 mb-0">Paul</h5>
                                                            <p class="text-muted mb-0 mt-1">27 Followers, 66 Reviews</p>
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

                                    <div class="mt-2">
                                        <div class="border rounded mt-4">
                                            <form action="#">
                                                <div class="px-2 py-1 bg-light">
                                                    <div class="btn-group" role="group">
                                                        <button type="button"
                                                            class="btn btn-sm btn-link text-darbodyxt-decoration-none"><i
                                                                class="bx bx-link"></i></button>
                                                        <button type="button"
                                                            class="btn btn-sm btn-link text-darbodyxt-decoration-none"><i
                                                                class="bx bx-smile"></i></button>
                                                        <button type="button"
                                                            class="btn btn-sm btn-link text-darbodyxt-decoration-none"><i
                                                                class="bx bx-at"></i></button>
                                                    </div>
                                                </div>
                                                <textarea rows="3" class="form-control border-0 resize-none" placeholder="Your Message..."></textarea>
                                            </form>
                                        </div>

                                        <div class="text-end mt-3">
                                            <button type="button" class="btn btn-success w-sm text-truncate ms-2"> Send
                                                <i class="bx bx-send ms-2 align-middle"></i></button>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="post" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="mx-n3 px-3" data-simplebar style="max-height: 580px;">
                                    <div class="blog-post">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}" alt=""
                                                    class="avatar-md rounded-circle img-thumbnail">
                                            </div>
                                            <div class="flex-1">
                                                <h5 class="font-size-16 text-truncate mb-1"><a href="#"
                                                        class="text-body">Richard Johnson</a></h5>
                                                <p class="font-size-13 text-muted mb-0">24 Mar, 2021</p>
                                            </div>
                                        </div>
                                        <div class="pt-3">
                                            <p class="text-muted">Aenean ornare mauris velit. Donec imperdiet, massa sit
                                                amet porta maximus, massa justo faucibus nisi,
                                                eget accumsan nunc ipsum nec lacus. Etiam dignissim turpis sit amet lectus
                                                porttitor eleifend. Maecenas ornare molestie metus eget feugiat.
                                                Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>

                                        </div>
                                        <div class="position-relative mt-3">
                                            <img src="{{ URL::asset('build/images/post-1.jpg') }}" alt="" class="img-thumbnail">
                                        </div>
                                        <div class="pt-3">
                                            <div
                                                class="d-flex align-items-center justify-content-between border-bottom pb-3">
                                                <div>
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item me-3">
                                                            <a href="javascript: void(0);" class="text-muted">
                                                                <i class="bx bx-purchase-tag-alt text-muted me-1"></i>
                                                                Project
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item me-3">
                                                            <a href="javascript: void(0);" class="text-muted">
                                                                <i class="bx bx-like align-middle text-muted me-1"></i> 12
                                                                Like
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-group">
                                                            <div class="avatar-group-item">
                                                                <a href="javascript: void(0);" class="d-inline-block">
                                                                    <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}"
                                                                        alt="" class="rounded-circle avatar-sm">
                                                                </a>
                                                            </div>
                                                            <div class="avatar-group-item">
                                                                <a href="javascript: void(0);" class="d-inline-block">
                                                                    <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}"
                                                                        alt="" class="rounded-circle avatar-sm">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="ms-2">
                                                            <button type="button"
                                                                class="btn btn-outline-primary btn-sm waves-effect">Share
                                                                <i class="bx bx-share-alt align-middle ms-1"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end blog post -->

                                    <div class="blog-post mt-3">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" alt=""
                                                    class="avatar-md rounded-circle img-thumbnail">
                                            </div>
                                            <div class="flex-1">
                                                <h5 class="font-size-16 text-truncate mb-1"><a href="#"
                                                        class="text-body">James Delgado</a></h5>
                                                <p class="font-size-13 text-muted mb-0">29 July, 2021</p>
                                            </div>
                                        </div>
                                        <div class="pt-3">
                                            <p class="text-muted">Aenean ornare mauris velit. Donec imperdiet, massa sit
                                                amet porta maximus, massa justo faucibus nisi,
                                                eget accumsan nunc ipsum nec lacus. Etiam dignissim turpis sit amet lectus
                                                porttitor eleifend. Maecenas ornare molestie metus eget feugiat.
                                                Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>

                                        </div>
                                        <div class="position-relative mt-3">
                                            <img src="{{ URL::asset('build/images/post-2.jpg') }}" alt="" class="img-thumbnail">
                                        </div>
                                        <div class="pt-3">
                                            <div
                                                class="d-flex align-items-center justify-content-between border-bottom pb-3">
                                                <div>
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item me-3">
                                                            <a href="javascript: void(0);" class="text-muted">
                                                                <i class="bx bx-purchase-tag-alt text-muted me-1"></i>
                                                                Project
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item me-3">
                                                            <a href="javascript: void(0);" class="text-muted">
                                                                <i class="bx bx-like align-middle text-muted me-1"></i> 12
                                                                Like
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-group">
                                                            <div class="avatar-group-item">
                                                                <a href="javascript: void(0);" class="d-inline-block">
                                                                    <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}"
                                                                        alt="" class="rounded-circle avatar-sm">
                                                                </a>
                                                            </div>
                                                            <div class="avatar-group-item">
                                                                <a href="javascript: void(0);" class="d-inline-block">
                                                                    <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}"
                                                                        alt="" class="rounded-circle avatar-sm">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="ms-2">
                                                            <button type="button"
                                                                class="btn btn-outline-primary btn-sm waves-effect">Share
                                                                <i class="bx bx-share-alt align-middle ms-1"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end blog post -->
                                </div>

                            </div>
                            <!-- end card body -->
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- end row -->


        <div class="row">

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Weekly Hours</h5>
                    </div>
                    <div class="card-body">
                        <div id="overview-chart" data-colors='["#1f58c7"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Team Members</h5>
                    </div>

                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <td style="width: 50px;"><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="rounded-circle avatar-sm" alt=""></td>
                                        <td>
                                            <h5 class="font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Daniel Canales</a></h5>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);"
                                                    class="badge bg-primary-subtle text-primary font-size-11">Frontend</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i
                                                class="mdi mdi-circle-medium font-size-18 text-success align-middle me-1"></i>
                                            Online
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" class="rounded-circle avatar-sm"
                                                alt=""></td>
                                        <td>
                                            <h5 class="font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Jennifer Walker</a></h5>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);"
                                                    class="badge bg-primary-subtle text-primary font-size-11">UI / UX</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i
                                                class="mdi mdi-circle-medium font-size-18 text-warning align-middle me-1"></i>
                                            Buzy
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="avatar-sm">
                                                <span
                                                    class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                    C
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Carl Mackay</a></h5>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);"
                                                    class="badge bg-primary-subtle text-primary font-size-11">Backend</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i
                                                class="mdi mdi-circle-medium font-size-18 text-success align-middle me-1"></i>
                                            Online
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" class="rounded-circle avatar-sm"
                                                alt=""></td>
                                        <td>
                                            <h5 class="font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Janice Cole</a></h5>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);"
                                                    class="badge bg-primary-subtle text-primary font-size-11">Frontend</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i
                                                class="mdi mdi-circle-medium font-size-18 text-success align-middle me-1"></i>
                                            Online
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="avatar-sm">
                                                <span
                                                    class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                    T
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Tony Brafford</a></h5>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);"
                                                    class="badge bg-primary-subtle text-primary font-size-11">Backend</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i
                                                class="mdi mdi-circle-medium font-size-18 text-secondary align-middle me-1"></i>
                                            Offline
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Skill</h5>
                    </div>
                    <div class="card-body">

                        <div class="row align-items-center g-0">
                            <div class="col-sm-3">
                                <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-primary me-2"></i>
                                    Photoshop </p>
                            </div>

                            <div class="col-sm-9">
                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar progress-bar bg-primary" role="progressbar"
                                        style="width: 72%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row-->

                        <div class="row align-items-center g-0 mt-3">
                            <div class="col-sm-3">
                                <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-primary me-2"></i>
                                    illustrator </p>
                            </div>
                            <div class="col-sm-9">
                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar progress-bar bg-primary" role="progressbar"
                                        style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row-->

                        <div class="row align-items-center g-0 mt-3">
                            <div class="col-sm-3">
                                <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-primary me-2"></i>
                                    HTML </p>
                            </div>
                            <div class="col-sm-9">
                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar progress-bar bg-primary" role="progressbar"
                                        style="width: 68%" aria-valuenow="48" aria-valuemin="0" aria-valuemax="48">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row-->

                        <div class="row align-items-center g-0 mt-3">
                            <div class="col-sm-3">
                                <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-primary me-2"></i>
                                    CSS </p>
                            </div>
                            <div class="col-sm-9">
                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar progress-bar bg-primary" role="progressbar"
                                        style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row-->

                        <div class="row align-items-center g-0 mt-3">
                            <div class="col-sm-3">
                                <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-primary me-2"></i>
                                    Javascript </p>
                            </div>
                            <div class="col-sm-9">
                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar progress-bar bg-primary" role="progressbar"
                                        style="width: 63%" aria-valuenow="63" aria-valuemin="0" aria-valuemax="63">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row-->

                        <div class="row align-items-center g-0 mt-3">
                            <div class="col-sm-3">
                                <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-primary me-2"></i>
                                    Php </p>
                            </div>
                            <div class="col-sm-9">
                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar progress-bar bg-primary" role="progressbar"
                                        style="width: 48%" aria-valuenow="48" aria-valuemin="0" aria-valuemax="48">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row-->

                        <div class="row align-items-center g-0 mt-3">
                            <div class="col-sm-3">
                                <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-primary me-2"></i>
                                    Python </p>
                            </div>
                            <div class="col-sm-9">
                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar progress-bar bg-primary" role="progressbar"
                                        style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row-->

                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/profile.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
