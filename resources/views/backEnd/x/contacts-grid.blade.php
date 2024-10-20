@extends('backEnd.layouts.master')
@section('title')
    User Grid
@endsection
@section('page-title')
    User Grid
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">Contact List <span class="text-muted fw-normal ms-2">(834)</span></h5>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                    <div>
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link" href="contacts-list" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="List"><i class="bx bx-list-ul"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="contacts-grid" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Grid"><i class="bx bx-grid-alt"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <a href="#" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary"><i
                                class="bx bx-plus me-1"></i> Add New</a>
                    </div>
                    <div class="dropdown">
                        <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <!-- end row -->

        <div class="row mt-2">
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a class="text-muted dropdown-toggle font-size-16" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true">
                                <i class="bx bx-dots-horizontal text-muted font-size-20"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Remove</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div>
                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt=""
                                    class="avatar-md rounded-circle img-thumbnail">
                            </div>
                            <div class="flex-1 ms-3">
                                <h5 class="font-size-16 mb-1"><a href="#" class="text-body">Phyllis Gatlin</a></h5>
                                <span class="badge bg-success-subtle text-success mb-0">Full Stack Developer</span>
                            </div>
                        </div>

                        <p class="text-muted mt-3 mb-0">Curabitur non magna lobortis tempus gravida ornare libero sed diam
                            sed fringilla est.</p>

                        <div class="mt-3 pt-1">
                            <p class="mb-0"><i class="mdi mdi-phone font-size-15 align-middle pe-2 text-primary"></i>
                                070 2860 5375</p>
                            <p class="mb-0 mt-2"><i class="mdi mdi-email font-size-15 align-middle pe-2 text-primary"></i>
                                PhyllisGatlin@spy.com</p>
                            <p class="mb-0 mt-2"><i
                                    class="mdi mdi-google-maps font-size-15 align-middle pe-2 text-primary"></i>
                                52 Ilchester MYBSTER 9WX</p>
                        </div>

                        <div class="d-flex gap-2 pt-4">
                            <button type="button" class="btn btn-subtle-primary btn-sm w-50"><i class="bx bx-user me-1"></i>
                                Profile</button>
                            <button type="button" class="btn btn-primary btn-sm w-50"><i
                                    class="bx bx-message-square-dots me-1"></i> Contact</button>
                        </div>


                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a class="text-muted dropdown-toggle font-size-16" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true">
                                <i class="bx bx-dots-horizontal text-muted font-size-20"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Remove</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div>
                                <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt=""
                                    class="avatar-md rounded-circle img-thumbnail">
                            </div>
                            <div class="flex-1 ms-3">
                                <h5 class="font-size-16 mb-1"><a href="#" class="text-body">James Nix</a></h5>
                                <span class="badge bg-success-subtle text-success mb-0">Full Stack Developer</span>
                            </div>
                        </div>

                        <p class="text-muted mt-3 mb-0">Curabitur non magna lobortis tempus gravida ornare libero sed diam
                            sed fringilla est.</p>

                        <div class="mt-3 pt-1">
                            <p class="mb-0"><i class="mdi mdi-phone font-size-15 align-middle pe-2 text-primary"></i>
                                046 5685 6969</p>
                            <p class="mb-0 mt-2"><i class="mdi mdi-email font-size-15 align-middle pe-2 text-primary"></i>
                                JamesNix@spy.com</p>
                            <p class="mb-0 mt-2"><i
                                    class="mdi mdi-google-maps font-size-15 align-middle pe-2 text-primary"></i>
                                5 Boar Lane SELLING 2LG</p>
                        </div>

                        <div class="d-flex gap-2 pt-4">
                            <button type="button" class="btn btn-subtle-primary btn-sm w-50"><i
                                    class="bx bx-user me-1"></i> Profile</button>
                            <button type="button" class="btn btn-primary btn-sm w-50"><i
                                    class="bx bx-message-square-dots me-1"></i> Contact</button>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a class="text-muted dropdown-toggle font-size-16" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true">
                                <i class="bx bx-dots-horizontal text-muted font-size-20"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Remove</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div>
                                <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt=""
                                    class="avatar-md rounded-circle img-thumbnail">
                            </div>
                            <div class="flex-1 ms-3">
                                <h5 class="font-size-16 mb-1"><a href="#" class="text-body">Darlene Smith</a></h5>
                                <span class="badge bg-danger-subtle text-danger mb-0">UI/UX Designer</span>
                            </div>
                        </div>

                        <p class="text-muted mt-3 mb-0">Curabitur non magna lobortis tempus gravida ornare libero sed diam
                            sed fringilla est.</p>

                        <div class="mt-3 pt-1">
                            <p class="mb-0"><i class="mdi mdi-phone font-size-15 align-middle pe-2 text-primary"></i>
                                012 6587 1236</p>
                            <p class="mb-0 mt-2"><i class="mdi mdi-email font-size-15 align-middle pe-2 text-primary"></i>
                                DarleneSmith@spy.com</p>
                            <p class="mb-0 mt-2"><i
                                    class="mdi mdi-google-maps font-size-15 align-middle pe-2 text-primary"></i>
                                57 Guildry Street GAMRIE</p>
                        </div>

                        <div class="d-flex gap-2 pt-4">
                            <button type="button" class="btn btn-subtle-primary btn-sm w-50"><i
                                    class="bx bx-user me-1"></i> Profile</button>
                            <button type="button" class="btn btn-primary btn-sm w-50"><i
                                    class="bx bx-message-square-dots me-1"></i> Contact</button>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a class="text-muted dropdown-toggle font-size-16" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true">
                                <i class="bx bx-dots-horizontal text-muted font-size-20"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Remove</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="avatar-md">
                                <div class="avatar-title bg-soft-primary text-primary display-6 m-0 rounded-circle">
                                    <i class="bx bxs-user-circle"></i>
                                </div>
                            </div>
                            <div class="flex-1 ms-3">
                                <h5 class="font-size-16 mb-1"><a href="#" class="text-body">William Swift</a></h5>
                                <span class="badge bg-warning-subtle text-warning mb-0">Backend Developer</span>
                            </div>
                        </div>

                        <p class="text-muted mt-3 mb-0">Curabitur non magna lobortis tempus gravida ornare libero sed diam
                            sed fringilla est.</p>

                        <div class="mt-3 pt-1">
                            <p class="mb-0"><i class="mdi mdi-phone font-size-15 align-middle pe-2 text-primary"></i>
                                012 6587 1236</p>
                            <p class="mb-0 mt-2"><i class="mdi mdi-email font-size-15 align-middle pe-2 text-primary"></i>
                                WilliamSwift@spy.com</p>
                            <p class="mb-0 mt-2"><i
                                    class="mdi mdi-google-maps font-size-15 align-middle pe-2 text-primary"></i>
                                80 South Street MONKW 7BR</p>
                        </div>

                        <div class="d-flex gap-2 pt-4">
                            <button type="button" class="btn btn-subtle-primary btn-sm w-50"><i
                                    class="bx bx-user me-1"></i> Profile</button>
                            <button type="button" class="btn btn-primary btn-sm w-50"><i
                                    class="bx bx-message-square-dots me-1"></i> Contact</button>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a class="text-muted dropdown-toggle font-size-16" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true">
                                <i class="bx bx-dots-horizontal text-muted font-size-20"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Remove</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="avatar-md">
                                <div class="avatar-title bg-soft-primary text-primary display-6 m-0 rounded-circle">
                                    <i class="bx bxs-user-circle"></i>
                                </div>
                            </div>
                            <div class="flex-1 ms-3">
                                <h5 class="font-size-16 mb-1"><a href="#" class="text-body">Kevin West</a></h5>
                                <span class="badge bg-success-subtle text-success mb-0">Full Stack Developer</span>
                            </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">Curabitur non magna lobortis tempus gravida ornare libero sed diam
                            sed fringilla est.</p>

                        <div class="mt-3 pt-1">
                            <p class="mb-0"><i class="mdi mdi-phone font-size-15 align-middle pe-2 text-primary"></i>
                                052 6524 9896</p>
                            <p class="mb-0 mt-2"><i class="mdi mdi-email font-size-15 align-middle pe-2 text-primary"></i>
                                KevinWest@spy.com</p>
                            <p class="mb-0 mt-2"><i
                                    class="mdi mdi-google-maps font-size-15 align-middle pe-2 text-primary"></i>
                                88 Tadcaster PINCHBECK 6UB</p>
                        </div>

                        <div class="d-flex gap-2 pt-4">
                            <button type="button" class="btn btn-subtle-primary btn-sm w-50"><i
                                    class="bx bx-user me-1"></i> Profile</button>
                            <button type="button" class="btn btn-primary btn-sm w-50"><i
                                    class="bx bx-message-square-dots me-1"></i> Contact</button>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a class="text-muted dropdown-toggle font-size-16" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true">
                                <i class="bx bx-dots-horizontal text-muted font-size-20"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Remove</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div>
                                <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}" alt=""
                                    class="avatar-md rounded-circle img-thumbnail">
                            </div>
                            <div class="flex-1 ms-3">
                                <h5 class="font-size-16 mb-1"><a href="#" class="text-body">Tommy Hayes</a></h5>
                                <span class="badge bg-warning-subtle text-warning mb-0">Backend Developer</span>
                            </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">Curabitur non magna lobortis tempus gravida ornare libero sed diam
                            sed fringilla est.</p>

                        <div class="mt-3 pt-1">
                            <p class="mb-0"><i class="mdi mdi-phone font-size-15 align-middle pe-2 text-primary"></i>
                                065 2563 6587</p>
                            <p class="mb-0 mt-2"><i class="mdi mdi-email font-size-15 align-middle pe-2 text-primary"></i>
                                TommyHayes@spy.com</p>
                            <p class="mb-0 mt-2"><i
                                    class="mdi mdi-google-maps font-size-15 align-middle pe-2 text-primary"></i>
                                5 Boar Lane SELLING 2LG</p>
                        </div>

                        <div class="d-flex gap-2 pt-4">
                            <button type="button" class="btn btn-subtle-primary btn-sm w-50"><i
                                    class="bx bx-user me-1"></i> Profile</button>
                            <button type="button" class="btn btn-primary btn-sm w-50"><i
                                    class="bx bx-message-square-dots me-1"></i> Contact</button>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a class="text-muted dropdown-toggle font-size-16" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true">
                                <i class="bx bx-dots-horizontal text-muted font-size-20"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Remove</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div>
                                <img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}" alt=""
                                    class="avatar-md rounded-circle img-thumbnail">
                            </div>
                            <div class="flex-1 ms-3">
                                <h5 class="font-size-16 mb-1"><a href="#" class="text-body">Diana Owens</a></h5>
                                <span class="badge bg-danger-subtle text-danger mb-0">UI/UX Designer</span>
                            </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">Curabitur non magna lobortis tempus gravida ornare libero sed diam
                            sed fringilla est.</p>

                        <div class="mt-3 pt-1">
                            <p class="mb-0"><i class="mdi mdi-phone font-size-15 align-middle pe-2 text-primary"></i>
                                087 6321 3235</p>
                            <p class="mb-0 mt-2"><i class="mdi mdi-email font-size-15 align-middle pe-2 text-primary"></i>
                                DianaOwens@spy.com</p>
                            <p class="mb-0 mt-2"><i
                                    class="mdi mdi-google-maps font-size-15 align-middle pe-2 text-primary"></i>
                                52 Ilchester MYBSTER 9WX</p>
                        </div>

                        <div class="d-flex gap-2 pt-4">
                            <button type="button" class="btn btn-subtle-primary btn-sm w-50"><i
                                    class="bx bx-user me-1"></i> Profile</button>
                            <button type="button" class="btn btn-primary btn-sm w-50"><i
                                    class="bx bx-message-square-dots me-1"></i> Contact</button>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a class="text-muted dropdown-toggle font-size-16" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true">
                                <i class="bx bx-dots-horizontal text-muted font-size-20"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Remove</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div>
                                <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt=""
                                    class="avatar-md rounded-circle img-thumbnail">
                            </div>
                            <div class="flex-1 ms-3">
                                <h5 class="font-size-16 mb-1"><a href="#" class="text-body">Paul Sanchez</a></h5>
                                <span class="badge bg-success-subtle text-success mb-0">Full Stack Developer</span>
                            </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">Curabitur non magna lobortis tempus gravida ornare libero sed diam
                            sed fringilla est.</p>

                        <div class="mt-3 pt-1">
                            <p class="mb-0"><i class="mdi mdi-phone font-size-15 align-middle pe-2 text-primary"></i>
                                021 0125 5689</p>
                            <p class="mb-0 mt-2"><i class="mdi mdi-email font-size-15 align-middle pe-2 text-primary"></i>
                                DianaOwens@spy.com</p>
                            <p class="mb-0 mt-2"><i
                                    class="mdi mdi-google-maps font-size-15 align-middle pe-2 text-primary"></i>
                                80 South Street MONKW 7BR</p>
                        </div>

                        <div class="d-flex gap-2 pt-4">
                            <button type="button" class="btn btn-subtle-primary btn-sm w-50"><i
                                    class="bx bx-user me-1"></i> Profile</button>
                            <button type="button" class="btn btn-primary btn-sm w-50"><i
                                    class="bx bx-message-square-dots me-1"></i> Contact</button>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

        <div class="row g-0 align-items-center pb-3">
            <div class="col-sm-6">
                <div>
                    <p class="mb-sm-0">Showing 1 to 10 of 57 entries</p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="float-sm-end">
                    <ul class="pagination mb-sm-0">
                        <li class="page-item disabled">
                            <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
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
                            <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end row -->

        </div>
        <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!--  successfully modal  -->
        <div id="success-btn" class="modal fade" tabindex="-1" aria-labelledby="success-btnLabel" aria-hidden="true"
            data-bs-scroll="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="bx bx-check-circle display-1 text-success"></i>
                            <h4 class="mt-3">User Added Successfully</h4>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!--  Extra Large modal example -->
        <div class="modal fade add-new" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Add New</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddNew-Username">Username</label>
                                    <input type="text" class="form-control" placeholder="Enter Username"
                                        id="AddNew-Username">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Position</label>
                                    <select class="form-select">
                                        <option selected>Select Position</option>
                                        <option>Full Stack Developer</option>
                                        <option>Frontend Developer</option>
                                        <option>UI/UX Designer</option>
                                        <option>Backend Developer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddNew-Email">Email</label>
                                    <input type="text" class="form-control" placeholder="Enter Email"
                                        id="AddNew-Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddNew-Phone">Phone</label>
                                    <input type="text" class="form-control" placeholder="Enter Phone"
                                        id="AddNew-Phone">
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

    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
