@extends('backEnd.layouts.master')
@section('title')
    Sales
@endsection
@section('page-title')
    Sales
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="font-size-15">Sales</h6>
                                <h4 class="mt-3 pt-1 mb-0 font-size-22">$12,253 <span
                                        class="text-success fw-medium font-size-14 align-middle"> <i
                                            class="mdi mdi-arrow-up"></i>2.64% </span> </h4>
                            </div>
                            <div class="">
                                <div class="avatar">
                                    <div class="avatar-title rounded bg-primary-subtle">
                                        <i class="bx bx-store-alt font-size-24 mb-0 text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div id="mini-1" data-colors='["#e6ecf9"]' class="apex-charts"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mb-0 font-size-15">Purchase</h6>
                                <h4 class="mt-3 mb-0 font-size-22">$63,756 <span
                                        class="text-danger fw-medium font-size-14 align-middle"> <i
                                            class="mdi mdi-arrow-down"></i> 4.84% </span> </h4>

                            </div>

                            <div class="">
                                <div class="avatar">
                                    <div class="avatar-title rounded bg-primary-subtle">
                                        <i class="bx bx-money font-size-24 mb-0 text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div id="mini-2" data-colors='["#e6ecf9"]' class="apex-charts"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mb-0 font-size-15">Return</h6>
                                <h4 class="mt-3 mb-0 font-size-22">$14,568 <span
                                        class="text-success fw-medium font-size-14 align-middle"> <i
                                            class="mdi mdi-arrow-up"></i> 6.54% </span> </h4>
                            </div>

                            <div class="">
                                <div class="avatar">
                                    <div class="avatar-title rounded bg-primary-subtle">
                                        <i class="bx bx-revision font-size-24 mb-0 text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div id="mini-3" data-colors='["#e6ecf9"]' class="apex-charts"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mb-0 font-size-15">Marketing</h6>
                                <h4 class="mt-3 mb-0 font-size-22">$47,658 <span
                                        class="text-danger fw-medium font-size-14 align-middle"> <i
                                            class="mdi mdi-arrow-down"></i> 8.15% </span> </h4>
                            </div>

                            <div class="">
                                <div class="avatar">
                                    <div class="avatar-title rounded bg-primary-subtle">
                                        <i class="bx bx-chart font-size-24 mb-0 text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div id="mini-4" data-colors='["#e6ecf9"]' class="apex-charts"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->


        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-0">Sales Report</h5>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <span class="fw-semibold">Sort By:</span>
                                        <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Yearly</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                        <a class="dropdown-item" href="#">Today</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h4 class="font-size-22">$23,590.00</h4>
                            </div>
                            <div class="col-md-8">
                                <ul class="list-inline main-chart text-md-end mb-0">
                                    <li class="list-inline-item chart-border-left me-0 border-0">
                                        <h4 class="text-primary font-size-22">$584k <span
                                                class="text-muted d-inline-block font-size-14 align-middle ms-2">Incomes</span>
                                        </h4>
                                    </li>
                                    <li class="list-inline-item chart-border-left me-0">
                                        <h4 class="font-size-22">$497k<span
                                                class="text-muted d-inline-block font-size-14 align-middle ms-2">Expenses</span>
                                        </h4>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <div id="sales-report" data-colors='["#1f58c7","#e6ecf9"]' class="apex-charts"
                                dir="ltr"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-0">Source of Purchases</h5>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        Today<i class="mdi mdi-chevron-down ms-1"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Yearly</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                        <a class="dropdown-item" href="#">Today</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div>
                            <div id="chart-radialBar" class="apex-charts" data-colors='["#1f58c7"]'></div>
                        </div>

                        <div class="mt-4 px-1 pt-1">
                            <div class="mx-n4" data-simplebar style="max-height: 214px;">
                                <div class="border-bottom sale-social-box">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar">
                                                <div class="avatar-title rounded bg-primary-subtle">
                                                    <i class="bx bxl-facebook font-size-24 mb-0 text-primary"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3 overflow-hidden">
                                            <h5 class="font-size-15 mb-1 text-truncate">Facebook</h5>
                                            <p class="text-muted text-truncate mb-0">3.2k Sale - 4.2k Like</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <h5
                                                class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center">
                                                50% <i class="mdi mdi-arrow-top-right text-success align-middle"></i></h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-bottom sale-social-box">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar">
                                                <div class="avatar-title rounded bg-primary-subtle">
                                                    <i class="bx bxl-twitter font-size-24 mb-0 text-primary"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3 overflow-hidden">
                                            <h5 class="font-size-15 mb-1 text-truncate">Twitter</h5>
                                            <p class="text-muted text-truncate mb-0">3.1k Sale - 3.7k Like</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <h5
                                                class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center">
                                                34% <i class="mdi mdi-arrow-bottom-left text-danger align-middle"></i></h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-bottom sale-social-box">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar">
                                                <div class="avatar-title rounded bg-primary-subtle">
                                                    <i class="bx bxl-linkedin font-size-24 mb-0 text-primary"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3 overflow-hidden">
                                            <h5 class="font-size-15 mb-1 text-truncate">Linkedin </h5>
                                            <p class="text-muted text-truncate mb-0">2.1k Sale - 4.3k Like</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <h5
                                                class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center">
                                                64% <i class="mdi mdi-arrow-top-right text-success align-middle"></i></h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-bottom sale-social-box">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar">
                                                <div class="avatar-title rounded bg-primary-subtle">
                                                    <i class="bx bxl-youtube font-size-24 mb-0 text-primary"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3 overflow-hidden">
                                            <h5 class="font-size-15 mb-1 text-truncate">Youtube</h5>
                                            <p class="text-muted text-truncate mb-0">5.7k Sale - 8.4k Like</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <h5
                                                class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center">
                                                47% <i class="mdi mdi-arrow-bottom-left text-danger align-middle"></i></h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-bottom sale-social-box">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar">
                                                <div class="avatar-title rounded bg-primary-subtle">
                                                    <i class="bx bxl-google font-size-24 mb-0 text-primary"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3 overflow-hidden">
                                            <h5 class="font-size-15 mb-1 text-truncate">Google</h5>
                                            <p class="text-muted text-truncate mb-0">2.4k Sale - 3.7k Like</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <h5
                                                class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center">
                                                61% <i class="mdi mdi-arrow-bottom-left text-danger align-middle"></i></h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-bottom sale-social-box">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar">
                                                <div class="avatar-title rounded bg-primary-subtle">
                                                    <i class="bx bxl-github font-size-24 mb-0 text-primary"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3 overflow-hidden">
                                            <h5 class="font-size-15 mb-1 text-truncate">Github</h5>
                                            <p class="text-muted text-truncate mb-0">1.3k Sale - 8.6k Like</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <h5
                                                class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center">
                                                50% <i class="mdi mdi-arrow-bottom-left text-danger align-middle"></i></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->

        <div class="row">
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-1">
                            <div class="flex-grow-1">
                                <h5 class="card-title">Sales History</h5>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-horizontal font-size-22"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Yearly</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                        <a class="dropdown-item" href="#">Today</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mx-n4" data-simplebar style="max-height: 390px;">
                            <p class="text-muted mb-0">Recent</p>
                            <div class="border-bottom sales-history">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}"
                                            class="rounded-circle avatar img-thumbnail" alt="">
                                    </div>
                                    <div class="flex-grow-1 ms-3 overflow-hidden">
                                        <h5 class="font-size-15 mb-1 text-truncate">Neal Matthews</h5>
                                        <p class="font-size-14 text-muted text-truncate mb-0">United States</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span class="badge font-size-12 bg-danger-subtle text-danger">- $62.45</span>
                                    </div>
                                </div>
                            </div>

                            <div class="border-bottom sales-history">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}"
                                            class="rounded-circle avatar img-thumbnail" alt="">
                                    </div>
                                    <div class="flex-grow-1 ms-3 overflow-hidden">
                                        <h5 class="font-size-15 mb-1 text-truncate">Jamal Burnett</h5>
                                        <p class="font-size-14 text-muted text-truncate mb-0">India</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span class="badge font-size-12 bg-success-subtle text-success">+ $45.84</span>
                                    </div>
                                </div>
                            </div>

                            <p class="text-muted mt-3 mb-0">Yesterday</p>

                            <div class="border-bottom sales-history">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}"
                                            class="rounded-circle avatar img-thumbnail" alt="">
                                    </div>
                                    <div class="flex-grow-1 ms-3 overflow-hidden">
                                        <h5 class="font-size-15 mb-1 text-truncate">Barry Dick </h5>
                                        <p class="text-muted text-truncate mb-0">United States</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span class="badge font-size-12 bg-success-subtle text-success">+ $25.52</span>
                                    </div>
                                </div>
                            </div>

                            <div class="border-bottom sales-history">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}"
                                            class="rounded-circle avatar img-thumbnail" alt="">
                                    </div>
                                    <div class="flex-grow-1 ms-3 overflow-hidden">
                                        <h5 class="font-size-15 mb-1 text-truncate">Ronald Taylor</h5>
                                        <p class="text-muted text-truncate mb-0">United States</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span class="badge font-size-12 bg-danger-subtle text-danger">- $84.45</span>
                                    </div>
                                </div>
                            </div>

                            <div class="border-bottom sales-history">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                            class="rounded-circle avatar img-thumbnail" alt="">
                                    </div>
                                    <div class="flex-grow-1 ms-3 overflow-hidden">
                                        <h5 class="font-size-15 mb-1 text-truncate">Jacob Hunter</h5>
                                        <p class="text-muted text-truncate mb-0">England</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span class="badge font-size-12 bg-success-subtle text-success">+ $53.23</span>
                                    </div>
                                </div>
                            </div>

                            <div class="border-bottom sales-history">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                            class="rounded-circle avatar img-thumbnail" alt="">
                                    </div>
                                    <div class="flex-grow-1 ms-3 overflow-hidden">
                                        <h5 class="font-size-15 mb-1 text-truncate">William Cruz</h5>
                                        <p class="text-muted text-truncate mb-0">United States</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span class="badge font-size-12 bg-success-subtle text-success">+ $42.63</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card">
                    <div class="p-3 border-bottom">
                        <div class="row">
                            <div class="col-xl-4 col-7">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 avatar me-3 d-sm-block d-none">
                                        <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}" alt=""
                                            class="img-fluid d-block rounded-circle">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-16 mb-1 text-truncate"><a href="#"
                                                class="text-dark">Jennie Sherlock</a></h5>
                                        <p class="text-muted text-truncate mb-0">Online</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-8 col-5">
                                <ul class="list-inline user-chat-nav text-end mb-0">
                                    <li class="list-inline-item">
                                        <div class="dropdown">
                                            <button class="btn nav-btn dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-search"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-md p-2">
                                                <form class="px-2">
                                                    <div>
                                                        <input type="text" class="form-control border bg-soft-light"
                                                            placeholder="Search...">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="list-inline-item">
                                        <div class="dropdown">
                                            <button class="btn nav-btn dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Profile</a>
                                                <a class="dropdown-item" href="#">Archive</a>
                                                <a class="dropdown-item" href="#">Muted</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <div class="small-chat">
                        <div class="chat-conversation p-3" data-simplebar style="max-height: 316px;">
                            <ul class="list-unstyled mb-0">
                                <li class="chat-day-title">
                                    <span class="title">Today</span>
                                </li>

                                <li>
                                    <div class="conversation-list">
                                        <div class="d-flex">
                                            <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}"
                                                class="rounded-circle avatar" alt="">
                                            <div class="flex-1">
                                                <div class="ctext-wrap">
                                                    <div class="ctext-wrap-content">
                                                        <div class="conversation-name"><span class="time">10:00</span>
                                                        </div>
                                                        <p class="mb-0">Hi Jordan! <br>
                                                            Feels like it's been a while! Home are you?
                                                            with an ongoing project?</p>

                                                    </div>
                                                    <div class="dropdown align-self-start">
                                                        <a class="dropdown-toggle" href="#" role="button"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Copy</a>
                                                            <a class="dropdown-item" href="#">Save</a>
                                                            <a class="dropdown-item" href="#">Forward</a>
                                                            <a class="dropdown-item" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="right">
                                    <div class="conversation-list">
                                        <div class="d-flex">
                                            <div class="flex-1">
                                                <div class="ctext-wrap">
                                                    <div class="ctext-wrap-content">
                                                        <div class="conversation-name"><span class="time">10:02</span>
                                                        </div>
                                                        <p class="mb-0 text-start">Hi Martin, Glad to hear from you, I'm
                                                            fine,what about you? and how it's going with the velocity
                                                            website?

                                                        </p>

                                                    </div>
                                                    <div class="dropdown align-self-start">
                                                        <a class="dropdown-toggle" href="#" role="button"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Copy</a>
                                                            <a class="dropdown-item" href="#">Save</a>
                                                            <a class="dropdown-item" href="#">Forward</a>
                                                            <a class="dropdown-item" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                                class="rounded-circle avatar" alt="">
                                        </div>

                                    </div>

                                </li>

                                <li>
                                    <div class="conversation-list">
                                        <div class="d-flex">
                                            <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}"
                                                class="rounded-circle avatar" alt="">
                                            <div class="flex-1">
                                                <div class="ctext-wrap">
                                                    <div class="ctext-wrap-content">
                                                        <div class="conversation-name"><span class="time">10:04</span>
                                                        </div>
                                                        <p class="mb-0">
                                                            Super, I will get you the new brief for our own site over to you
                                                            this evening, so you have time to read over I'm good thank you!
                                                        </p>
                                                    </div>
                                                    <div class="dropdown align-self-start">
                                                        <a class="dropdown-toggle" href="#" role="button"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Copy</a>
                                                            <a class="dropdown-item" href="#">Save</a>
                                                            <a class="dropdown-item" href="#">Forward</a>
                                                            <a class="dropdown-item" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </li>

                                <li class="right">
                                    <div class="conversation-list">
                                        <div class="d-flex">
                                            <div class="flex-1">
                                                <div class="ctext-wrap">
                                                    <div class="ctext-wrap-content">
                                                        <div class="conversation-name"><span class="time">10:08</span>
                                                        </div>
                                                        <p class="mb-0 text-start">
                                                            Of course I can, just catching up with Steve on it and i'll
                                                            write
                                                            it out.
                                                        </p>

                                                        <p class="mb-0 text-start mt-2">
                                                            img-1.jpg & img-2.jpg images for a New Projects
                                                        </p>

                                                        <ul class="list-inline message-img mt-2 mb-0">
                                                            <li class="list-inline-item message-img-list">
                                                                <a class="d-inline-block" href="">
                                                                    <img src="{{ URL::asset('build/images/small/img-1.jpg') }}"
                                                                        alt="" class="rounded img-thumbnail">
                                                                </a>
                                                            </li>

                                                            <li class="list-inline-item message-img-list">
                                                                <a class="d-inline-block" href="">
                                                                    <img src="{{ URL::asset('build/images/small/img-2.jpg') }}"
                                                                        alt="" class="rounded img-thumbnail">
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="dropdown align-self-start">
                                                        <a class="dropdown-toggle" href="#" role="button"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Copy</a>
                                                            <a class="dropdown-item" href="#">Save</a>
                                                            <a class="dropdown-item" href="#">Forward</a>
                                                            <a class="dropdown-item" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                                class="rounded-circle avatar" alt="">
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="conversation-list">
                                        <div class="d-flex">
                                            <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}"
                                                class="rounded-circle avatar" alt="">
                                            <div class="flex-1">
                                                <div class="ctext-wrap">
                                                    <div class="ctext-wrap-content">
                                                        <div class="conversation-name"><span class="time">10:06</span>
                                                        </div>
                                                        <p class="mb-0">
                                                            Thank You very much, I am waiting Project.
                                                        </p>
                                                    </div>
                                                    <div class="dropdown align-self-start">
                                                        <a class="dropdown-toggle" href="#" role="button"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Copy</a>
                                                            <a class="dropdown-item" href="#">Save</a>
                                                            <a class="dropdown-item" href="#">Forward</a>
                                                            <a class="dropdown-item" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="right">
                                    <div class="conversation-list">
                                        <div class="d-flex">
                                            <div class="flex-1">
                                                <div class="ctext-wrap">
                                                    <div class="ctext-wrap-content">
                                                        <div class="conversation-name"><span class="time">10:08</span>
                                                        </div>
                                                        <p class="mb-0 text-start">
                                                            When someone thanks us, our automatic response is to say,
                                                            “You’re welcome.” This is something that we have
                                                            learned from our parents and family and have been doing for a
                                                            long time.
                                                        </p>
                                                    </div>

                                                    <div class="dropdown align-self-start">
                                                        <a class="dropdown-toggle" href="#" role="button"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Copy</a>
                                                            <a class="dropdown-item" href="#">Save</a>
                                                            <a class="dropdown-item" href="#">Forward</a>
                                                            <a class="dropdown-item" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                                class="rounded-circle avatar" alt="">
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>

                        <div class="p-3 border-top">
                            <div class="row">
                                <div class="col">
                                    <div class="position-relative">
                                        <input type="text" class="form-control border bg-light-subtle"
                                            placeholder="Enter Message...">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit"
                                        class="btn btn-primary chat-send w-md waves-effect waves-light"><span
                                            class="d-none d-sm-inline-block me-2">Send</span> <i
                                            class="mdi mdi-send float-end"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xl-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-3">
                            <div class="flex-grow-1">
                                <h5 class="card-title">Top Sales Countries</h5>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <span class="fw-semibold">Sort By:</span>
                                        <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Yearly</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                        <a class="dropdown-item" href="#">Today</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="text-center">
                                    <h4 class="font-size-18">23,568</h4>
                                    <p class="mb-1 text-muted font-size-14">Completed <span
                                            class="badge bg-success-subtle text-success">+40%</span></p>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="text-center">
                                    <h4 class="font-size-18">12,865</h4>
                                    <p class="mb-1 text-muted font-size-14">Pending <span
                                            class="badge bg-danger-subtle text-danger">-10%</span></p>

                                </div>
                            </div>

                            <div class="col-4">
                                <div class="text-center">
                                    <h4 class="font-size-18">2,355</h4>
                                    <p class="mb-1 text-muted font-size-14">Cancel <span
                                            class="badge bg-success-subtle text-success">+20%</span></p>

                                </div>
                            </div>
                        </div>

                        <div>
                            <div id="sales-countries" data-colors='["#1f58c7"]' class="apex-charts" dir="ltr">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center mb-2">
                            <h5 class="card-title">Products Of The Month</h5>
                            <div class="ms-auto">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="text-muted font-size-12">Sort By: </span> <span class="fw-medium">
                                            Monthly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                        <a class="dropdown-item" href="#">Weekly</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Yearly</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
                                <thead>
                                    <tr>
                                        <th style="width: 90px;">
                                            Product
                                        </th>
                                        <th style="width: 210px;">Product Name</th>
                                        <th>Customer Name</th>
                                        <th>Order ID</th>
                                        <th>Color</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th style="width: 270px;">Trend</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="avatar">
                                                <div
                                                    class="product-img avatar-title img-thumbnail bg-primary-subtle border-0">
                                                    <img src="{{ URL::asset('build/images/product/img-1.png') }}"
                                                        class="img-fluid" alt="">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="fw-semibold">Office Chair Crime</td>
                                        <td>
                                            Neal Matthews
                                        </td>
                                        <td>
                                            #526552
                                        </td>
                                        <td>
                                            Gray
                                        </td>
                                        <td>12/01/2022</td>
                                        <td><span class="badge bg-primary-subtle text-primary font-size-12">Pending</span></td>
                                        <td>
                                            <div id="chart-sparkline1" data-colors='["#1f58c7"]'></div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-18" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Print</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="avatar">
                                                <div
                                                    class="product-img avatar-title img-thumbnail bg-success-subtle border-0">
                                                    <img src="{{ URL::asset('build/images/product/img-2.png') }}"
                                                        class="img-fluid" alt="">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="fw-semibold">Sofa Home Chair Black</td>
                                        <td>
                                            Connie Franco
                                        </td>
                                        <td>
                                            #746648
                                        </td>
                                        <td>
                                            Black
                                        </td>
                                        <td>14/01/2022</td>
                                        <td><span class="badge bg-success-subtle text-success font-size-12">Active</span></td>
                                        <td>
                                            <div id="chart-sparkline2" data-colors='["#1f58c7"]'></div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-18" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Print</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="avatar">
                                                <div
                                                    class="product-img avatar-title img-thumbnail bg-danger-subtle border-0">
                                                    <img src="{{ URL::asset('build/images/product/img-3.png') }}"
                                                        class="img-fluid" alt="">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="fw-semibold">Tuition Classes Chair</td>
                                        <td>
                                            Paul Reynolds
                                        </td>
                                        <td>
                                            #125635
                                        </td>
                                        <td>
                                            Crime
                                        </td>
                                        <td>17/01/2022</td>
                                        <td><span class="badge bg-success-subtle text-success font-size-12">Active</span></td>
                                        <td>
                                            <div id="chart-sparkline3" data-colors='["#1f58c7"]'></div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-18" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Print</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="avatar">
                                                <div
                                                    class="product-img avatar-title img-thumbnail bg-primary-subtle border-0">
                                                    <img src="{{ URL::asset('build/images/product/img-4.png') }}"
                                                        class="img-fluid" alt="">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="fw-semibold">Dining Table Chair</td>
                                        <td>
                                            Ronald Patterson
                                        </td>
                                        <td>
                                            #236521
                                        </td>
                                        <td>
                                            Crime
                                        </td>
                                        <td>18/01/2022</td>
                                        <td><span class="badge bg-primary-subtle text-primary font-size-12">Pending</span></td>
                                        <td>
                                            <div id="chart-sparkline4" data-colors='["#1f58c7"]'></div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-18" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Print</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="avatar">
                                                <div
                                                    class="product-img avatar-title img-thumbnail bg-success-subtle border-0">
                                                    <img src="{{ URL::asset('build/images/product/img-5.png') }}"
                                                        class="img-fluid" alt="">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="fw-semibold">Home & Office Chair</td>
                                        <td>
                                            Adella Perez
                                        </td>
                                        <td>
                                            #236521
                                        </td>
                                        <td>
                                            Crime
                                        </td>
                                        <td>18/01/2022</td>
                                        <td><span class="badge bg-primary-subtle text-primary font-size-12">Pending</span></td>
                                        <td>
                                            <div id="chart-sparkline5" data-colors='["#1f58c7"]'></div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-18" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Print</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
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
        <!-- end row -->
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/dashboard-sales.init.js') }}"></script>

        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
