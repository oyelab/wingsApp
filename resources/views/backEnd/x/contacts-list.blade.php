@extends('backEnd.layouts.master')
@section('title')
    User List
@endsection
@section('page-title')
    User List
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
                                <a class="nav-link active" href="contacts-list" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="" data-bs-original-title="List"
                                    aria-label="List"><i class="bx bx-list-ul"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contacts-grid" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="" data-bs-original-title="Grid"
                                    aria-label="Grid"><i class="bx bx-grid-alt"></i></a>
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

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-nowrap align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="ps-4" style="width: 50px;">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck">
                                                <label class="form-check-label" for="contacusercheck"></label>
                                            </div>
                                        </th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Position</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Projects</th>
                                        <th scope="col" style="width: 200px;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <th scope="row" class="ps-4">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck1">
                                                <label class="form-check-label" for="contacusercheck1"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt=""
                                                class="avatar rounded-circle img-thumbnail me-2">
                                            <a href="#" class="text-body">Simon Ryles</a>
                                        </td>
                                        <td><span class="badge bg-success-subtle text-success mb-0">Full Stack Developer</span></td>
                                        <td>SimonRyles@minible.com</td>
                                        <td>125</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit" class="px-2 text-primary"><i
                                                            class="bx bx-pencil font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Delete" class="px-2 text-danger"><i
                                                            class="bx bx-trash-alt font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18 px-2" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row" class="ps-4">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck2">
                                                <label class="form-check-label" for="contacusercheck2"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt=""
                                                class="avatar rounded-circle img-thumbnail me-2">
                                            <a href="#" class="text-body">Marion Walker</a>
                                        </td>
                                        <td><span class="badge bg-info-subtle text-info mb-0">Frontend Developer</span></td>
                                        <td>MarionWalker@minible.com</td>
                                        <td>132</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit"
                                                        class="px-2 text-primary"><i
                                                            class="bx bx-pencil font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Delete"
                                                        class="px-2 text-danger"><i
                                                            class="bx bx-trash-alt font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18 px-2" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row" class="ps-4">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck3">
                                                <label class="form-check-label" for="contacusercheck3"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <div class="avatar d-inline-block me-2">
                                                <div class="avatar-title bg-primary-subtle rounded-circle text-primary">
                                                    <i class="mdi mdi-account-circle m-0 font-size-24"></i>
                                                </div>
                                            </div>
                                            <a href="#" class="text-body">Frederick White</a>
                                        </td>
                                        <td><span class="badge bg-danger-subtle text-danger mb-0">UI/UX Designer</span></td>
                                        <td>FrederickWhite@minible.com</td>
                                        <td>112</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit"
                                                        class="px-2 text-primary"><i
                                                            class="bx bx-pencil font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Delete"
                                                        class="px-2 text-danger"><i
                                                            class="bx bx-trash-alt font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18 px-2" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row" class="ps-4">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck4">
                                                <label class="form-check-label" for="contacusercheck4"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt=""
                                                class="avatar rounded-circle img-thumbnail me-2">
                                            <a href="#" class="text-body">Shanon Marvin</a>
                                        </td>
                                        <td><span class="badge bg-primary-subtle text-primary mb-0">Backend Developer</span></td>
                                        <td>ShanonMarvin@minible.com</td>
                                        <td>121</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit"
                                                        class="px-2 text-primary"><i
                                                            class="bx bx-pencil font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Delete"
                                                        class="px-2 text-danger"><i
                                                            class="bx bx-trash-alt font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18 px-2" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row" class="ps-4">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck5">
                                                <label class="form-check-label" for="contacusercheck5"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <div class="avatar d-inline-block me-2">
                                                <div class="avatar-title bg-primary-subtle rounded-circle text-primary">
                                                    <i class="mdi mdi-account-circle m-0 font-size-24"></i>
                                                </div>
                                            </div>
                                            <a href="#" class="text-body">Mark Jones</a>
                                        </td>
                                        <td><span class="badge bg-info-subtle text-info mb-0">Frontend Developer</span></td>
                                        <td>MarkJones@minible.com</td>
                                        <td>145</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit"
                                                        class="px-2 text-primary"><i
                                                            class="bx bx-pencil font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Delete"
                                                        class="px-2 text-danger"><i
                                                            class="bx bx-trash-alt font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18 px-2" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Remove</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row" class="ps-4">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck6">
                                                <label class="form-check-label" for="contacusercheck6"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" alt=""
                                                class="avatar rounded-circle img-thumbnail me-2">
                                            <a href="#" class="text-body">Janice Morgan</a>
                                        </td>
                                        <td><span class="badge bg-primary-subtle text-primary mb-0">Backend Developer</span></td>
                                        <td>JaniceMorgan@minible.com</td>
                                        <td>136</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit"
                                                        class="px-2 text-primary"><i
                                                            class="bx bx-pencil font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Delete"
                                                        class="px-2 text-danger"><i
                                                            class="bx bx-trash-alt font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18 px-2" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row" class="ps-4">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck7">
                                                <label class="form-check-label" for="contacusercheck7"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}" alt=""
                                                class="avatar rounded-circle img-thumbnail me-2">
                                            <a href="#" class="text-body">Patrick Petty</a>
                                        </td>
                                        <td><span class="badge bg-danger-subtle text-danger mb-0">UI/UX Designer</span></td>
                                        <td>PatrickPetty@minible.com</td>
                                        <td>125</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit"
                                                        class="px-2 text-primary"><i
                                                            class="bx bx-pencil font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Delete"
                                                        class="px-2 text-danger"><i
                                                            class="bx bx-trash-alt font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18 px-2" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row" class="ps-4">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck8">
                                                <label class="form-check-label" for="contacusercheck8"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}" alt=""
                                                class="avatar rounded-circle img-thumbnail me-2">
                                            <a href="#" class="text-body">Marilyn Horton</a>
                                        </td>
                                        <td><span class="badge bg-primary-subtle text-primary mb-0">Backend Developer</span></td>
                                        <td>MarilynHorton@minible.com</td>
                                        <td>154</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit"
                                                        class="px-2 text-primary"><i
                                                            class="bx bx-pencil font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Delete"
                                                        class="px-2 text-danger"><i
                                                            class="bx bx-trash-alt font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18 px-2" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row" class="ps-4">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck9">
                                                <label class="form-check-label" for="contacusercheck9"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt=""
                                                class="avatar rounded-circle img-thumbnail me-2">
                                            <a href="#" class="text-body">Neal Womack</a>
                                        </td>
                                        <td><span class="badge bg-success-subtle text-success mb-0">Full Stack Developer</span></td>
                                        <td>NealWomack@minible.com</td>
                                        <td>231</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit"
                                                        class="px-2 text-primary"><i
                                                            class="bx bx-pencil font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Delete"
                                                        class="px-2 text-danger"><i
                                                            class="bx bx-trash-alt font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18 px-2" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li>
                                            </ul>
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

        <div class="row g-0 align-items-center pb-4">
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
