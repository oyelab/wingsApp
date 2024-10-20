@extends('backEnd.layouts.master')
@section('title')
    Todo
@endsection
@section('css')
    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}">
@endsection
@section('page-title')
    Todo
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">

                        <div class="">
                            <div class="row mb-2">
                                <div class="col-xl-3 col-md-12">
                                    <div class="pb-3 pb-xl-0">
                                        <form class="email-search">
                                            <div class="position-relative">
                                                <input type="text" class="form-control bg-light" placeholder="Search...">
                                                <span class="bx bx-search font-size-18"></span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-xl-9 col-md-12">
                                    <div class="text-sm-end">
                                        <button type="button"
                                            class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                            data-bs-toggle="modal" data-bs-target=".create-task"><i
                                                class="mdi mdi-plus me-1"></i> Create Task</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-nowrap align-middle mb-0">
                                <tbody>
                                    <tr>
                                        <td style="width: 40px;">
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" id="upcomingtaskCheck01">
                                                <label class="form-check-label" for="upcomingtaskCheck01"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Create a webadmin Dashboard</a></h5>
                                        </td>
                                        <td>
                                            <p class="mb-0">
                                                <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 7
                                            </p>
                                        </td>
                                        <td>
                                            <p class="mb-0">Product Design</p>
                                        </td>

                                        <td>
                                            <div class="text-center">
                                                <span
                                                    class="badge rounded-pill bg-secondary-subtle text-secondary font-size-11">Waiting</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" id="upcomingtaskCheck02"
                                                    checked>
                                                <label class="form-check-label" for="upcomingtaskCheck02"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Create a New Landing</a></h5>
                                        </td>
                                        <td>
                                            <p class="mb-0">
                                                <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 8
                                            </p>
                                        </td>
                                        <td>
                                            <p class="mb-0">Development</p>
                                        </td>

                                        <td>
                                            <div class="text-center">
                                                <span
                                                    class="badge rounded-pill bg-primary-subtle text-primary font-size-11">Approved</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <div class="avatar-sm">
                                                            <span
                                                                class="avatar-title rounded-circle bg-success text-white font-size-16">
                                                                A
                                                            </span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" id="upcomingtaskCheck03">
                                                <label class="form-check-label" for="upcomingtaskCheck03"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Create a webadmin Logo</a></h5>
                                        </td>
                                        <td>
                                            <p class="mb-0">
                                                <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 5
                                            </p>
                                        </td>
                                        <td>
                                            <p class="mb-0">Illustration</p>
                                        </td>

                                        <td>
                                            <div class="text-center">
                                                <span
                                                    class="badge rounded-pill bg-secondary-subtle text-secondary font-size-11">Waiting</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <div class="avatar-sm">
                                                            <span
                                                                class="avatar-title rounded-circle bg-warning text-white font-size-16">
                                                                R
                                                            </span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" id="upcomingtaskCheck04">
                                                <label class="form-check-label" for="upcomingtaskCheck04"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Redesign - Landing page</a></h5>
                                        </td>
                                        <td>
                                            <p class="mb-0">
                                                <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 7
                                            </p>
                                        </td>
                                        <td>
                                            <p class="mb-0">Design</p>
                                        </td>

                                        <td>
                                            <div class="text-center">
                                                <span
                                                    class="badge rounded-pill bg-success-subtle text-success font-size-11">Completed</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <div class="avatar-sm">
                                                            <span
                                                                class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                                V
                                                            </span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" id="upcomingtaskCheck05">
                                                <label class="form-check-label" for="upcomingtaskCheck05"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Create a Blog Template</a></h5>
                                        </td>
                                        <td>
                                            <p class="mb-0">
                                                <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 5
                                            </p>
                                        </td>
                                        <td>
                                            <p class="mb-0">Angular</p>
                                        </td>

                                        <td>
                                            <div class="text-center">
                                                <span
                                                    class="badge rounded-pill bg-secondary-subtle text-secondary font-size-11">Waiting</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" id="upcomingtaskCheck06">
                                                <label class="form-check-label" for="upcomingtaskCheck06"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Minimal Multipurpose Landing</a></h5>
                                        </td>
                                        <td>
                                            <p class="mb-0">
                                                <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 2
                                            </p>
                                        </td>
                                        <td>
                                            <p class="mb-0">Backend</p>
                                        </td>

                                        <td>
                                            <div class="text-center">
                                                <span
                                                    class="badge rounded-pill bg-secondary-subtle text-secondary font-size-11">Waiting</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" id="upcomingtaskCheck07">
                                                <label class="form-check-label" for="upcomingtaskCheck07"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Fix Responsivenes for structure</a></h5>
                                        </td>
                                        <td>
                                            <p class="mb-0">
                                                <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 5
                                            </p>
                                        </td>
                                        <td>
                                            <p class="mb-0">Development</p>
                                        </td>

                                        <td>
                                            <div class="text-center">
                                                <span
                                                    class="badge rounded-pill bg-success-subtle text-success font-size-11">Completed</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <div class="avatar-sm">
                                                            <span
                                                                class="avatar-title rounded-circle bg-danger text-white font-size-16">
                                                                S
                                                            </span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" id="upcomingtaskCheck08"
                                                    checked>
                                                <label class="form-check-label" for="upcomingtaskCheck08"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Create a webadmin Dashboard</a></h5>
                                        </td>
                                        <td>
                                            <p class="mb-0">
                                                <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 9
                                            </p>
                                        </td>
                                        <td>
                                            <p class="mb-0">Illustration</p>
                                        </td>

                                        <td>
                                            <div class="text-center">
                                                <span
                                                    class="badge rounded-pill bg-primary-subtle text-primary font-size-11">Approved</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" id="upcomingtaskCheck09">
                                                <label class="form-check-label" for="upcomingtaskCheck09"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">New Widgets For Dashboard</a></h5>
                                        </td>
                                        <td>
                                            <p class="mb-0">
                                                <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 10
                                            </p>
                                        </td>
                                        <td>
                                            <p class="mb-0">Design</p>
                                        </td>

                                        <td>
                                            <div class="text-center">
                                                <span
                                                    class="badge rounded-pill bg-secondary-subtle text-secondary font-size-11">Waiting</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" id="upcomingtaskCheck10"
                                                    checked>
                                                <label class="form-check-label" for="upcomingtaskCheck10"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Old Landing Re-Design</a></h5>
                                        </td>
                                        <td>
                                            <p class="mb-0">
                                                <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 5
                                            </p>
                                        </td>
                                        <td>
                                            <p class="mb-0">Angular</p>
                                        </td>

                                        <td>
                                            <div class="text-center">
                                                <span
                                                    class="badge rounded-pill bg-primary-subtle text-primary font-size-11">Approved</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <div class="avatar-sm">
                                                            <span
                                                                class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                                V
                                                            </span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" id="upcomingtaskCheck11">
                                                <label class="form-check-label" for="upcomingtaskCheck11"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Create a Landing Page</a></h5>
                                        </td>
                                        <td>
                                            <p class="mb-0">
                                                <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 6
                                            </p>
                                        </td>
                                        <td>
                                            <p class="mb-0">Design</p>
                                        </td>

                                        <td>
                                            <div class="text-center">
                                                <span
                                                    class="badge rounded-pill bg-success-subtle text-success font-size-11">Completed</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-group">

                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <div class="avatar-sm">
                                                            <span
                                                                class="avatar-title rounded-circle bg-info text-white font-size-16">
                                                                R
                                                            </span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}" alt=""
                                                            class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

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
                        <h5 class="card-title mb-0">Avg. Team Time</h5>
                    </div>
                    <div class="card-body pt-0 pb-3">
                        <div id="overview-chart" data-colors='["#1f58c7"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Team Members</h5>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-1">
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
        </div>

        </div>
        <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!--  Extra Large modal example -->
        <div class="modal fade create-task" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Create Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Task Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Task Name"
                                        id="CreateTask-Task-Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Team-Member">Team Member</label>
                                    <input type="text" class="form-control" placeholder="Enter Team Member"
                                        id="CreateTask-Team-Member">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date</label>
                                    <input type="text" class="form-control" placeholder="Select Due Date"
                                        id="CreateTask-due-date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Category">Category</label>
                                    <select class="form-select">
                                        <option selected> Select Category </option>
                                        <option>Waiting</option>
                                        <option>Approved</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task Description">Task Description</label>
                                    <textarea class="form-control" id="projectdesc" rows="3" placeholder="Enter Task Description..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                                        class="bx bx-x me-1 align-middle"></i> Cancel</button>
                                <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#success-btn" id="btn-save-event"><i
                                        class="bx bx-check me-1 align-middle"></i> Confirm</button>
                            </div>
                        </div>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <!--  successfully modal  -->
        <div id="success-btn" class="modal fade" tabindex="-1" aria-labelledby="success-btnLabel" aria-hidden="true"
            data-bs-scroll="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="bx bx-check-circle display-1 text-success"></i>
                            <h4 class="mt-3">Task Completed Successfully</h4>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- datepicker js -->
        <script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>

        <!--  -->
        <script src="{{ URL::asset('build/js/pages/todo.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
