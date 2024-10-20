@extends('backEnd.layouts.master')
@section('title')
    FAQs
@endsection
@section('page-title')
    FAQs
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="text-center my-5">
                                    <img src="{{ URL::asset('build/images/faq-img.png') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mt-3">
                            <div class="col-xl-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body overflow-hidden position-relative">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm">
                                                    <span
                                                        class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                        <i class="bx bx-question-mark"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="font-size-17">What is Lorem Ipsum?</h5>
                                                <p class="text-muted mt-2 mb-0">New common language will be more simple and
                                                    regular than the existing European languages.</p>

                                                <div class="mt-3 pt-1">
                                                    <a href="" class="text-primary fw-semibold"> <u>Read More </u> <i
                                                            class="mdi mdi-arrow-right ms-1 align-middle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            <div class="col-xl-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body overflow-hidden position-relative">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm">
                                                    <span
                                                        class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                        <i class="bx bx-question-mark"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="font-size-17">Where does it come from?</h5>
                                                <p class="text-muted mt-2 mb-0">Everyone realizes why a new common language
                                                    would be
                                                    desirable one could refuse to pay expensive translators.</p>

                                                <div class="mt-3 pt-1">
                                                    <a href="" class="text-primary fw-semibold"> <u>Read More </u> <i
                                                            class="mdi mdi-arrow-right ms-1 align-middle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                            <div class="col-xl-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body overflow-hidden position-relative">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm">
                                                    <span
                                                        class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                        <i class="bx bx-question-mark"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="font-size-17">Where can I get some?</h5>
                                                <p class="text-muted mt-2 mb-0">If several languages coalesce, the grammar
                                                    of the
                                                    resulting language of the individual languages.</p>

                                                <div class="mt-3 pt-1">
                                                    <a href="" class="text-primary fw-semibold"> <u>Read More </u> <i
                                                            class="mdi mdi-arrow-right ms-1 align-middle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                            <div class="col-xl-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body overflow-hidden position-relative">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm">
                                                    <span
                                                        class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                        <i class="bx bx-question-mark"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="font-size-17">Why do we use it?</h5>
                                                <p class="text-muted mt-2 mb-0">Their separate existence is a myth. For
                                                    science, music,
                                                    sport, etc, Europe uses the same vocabulary.</p>

                                                <div class="mt-3 pt-1">
                                                    <a href="" class="text-primary fw-semibold"> <u>Read More </u> <i
                                                            class="mdi mdi-arrow-right ms-1 align-middle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                            <div class="col-xl-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body overflow-hidden position-relative">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm">
                                                    <span
                                                        class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                        <i class="bx bx-question-mark"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="font-size-17">Where can I get some?</h5>
                                                <p class="text-muted mt-2 mb-0">The point of using Lorem Ipsum is that it
                                                    has a
                                                    more-or-less normal opposed to using content here.</p>

                                                <div class="mt-3 pt-1">
                                                    <a href="" class="text-primary fw-semibold"> <u>Read More </u> <i
                                                            class="mdi mdi-arrow-right ms-1 align-middle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                            <div class="col-xl-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body overflow-hidden position-relative">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm">
                                                    <span
                                                        class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                        <i class="bx bx-question-mark"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="font-size-17">What is Lorem Ipsum?</h5>
                                                <p class="text-muted mt-2 mb-0">To an English person, it will seem like
                                                    simplified English,
                                                    as a skeptical Cambridge friend what Occidental.</p>

                                                <div class="mt-3 pt-1">
                                                    <a href="" class="text-primary fw-semibold"> <u>Read More </u> <i
                                                            class="mdi mdi-arrow-right ms-1 align-middle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
