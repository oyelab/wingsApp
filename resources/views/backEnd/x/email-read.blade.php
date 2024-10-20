@extends('backEnd.layouts.master')
@section('title')
    Read Email
@endsection
@section('page-title')
    Read Email
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <!-- Left sidebar -->
        <div class="email-leftbar">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-danger waves-effect waves-light w-100" data-bs-toggle="modal"
                        data-bs-target="#composemodal">
                        Compose
                    </button>

                    <div class="card p-0 overflow-hidden mt-4 shadow-none">
                        <div class="mail-list">
                            <a href="#" class="active bg-primary-subtle">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-email-outline font-size-20 align-middle me-3"></i>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-14 mb-0">All Inbox</h5>
                                        <span class="text-muted font-size-13 text-truncate">How To Boost Website</span>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="float-end">
                                            <span class="bg-primary badge">18</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="border-bottom">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-star-outline font-size-20 align-middle me-3"></i>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-14 mb-0">Starred</h5>
                                        <span class="text-muted font-size-13 text-truncate">Selected messages</span>
                                    </div>
                                    <div class="flex-shrink-0">
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="border-bottom">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-diamond-stone font-size-20 align-middle me-3"></i>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-14 mb-0">Important</h5>
                                        <span class="text-muted font-size-13 text-truncate">Selected messages</span>
                                    </div>
                                    <div class="flex-shrink-0">
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="border-bottom">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-file-outline font-size-20 align-middle me-3"></i>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-14 mb-0">Draft</h5>
                                        <span class="text-muted font-size-13 text-truncate">Re-edit your messages</span>
                                    </div>
                                    <div class="flex-shrink-0">
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="border-bottom">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-email-check-outline font-size-20 align-middle me-3"></i>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-14 mb-0">Sent Mail</h5>
                                        <span class="text-muted font-size-13 text-truncate">Successfully messages</span>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="float-end">
                                            <span class="bg-success badge">08</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="#">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-trash-can-outline font-size-20 align-middle me-3"></i>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-14 mb-0">Trash</h5>
                                        <span class="text-muted font-size-13 text-truncate">Removed messages</span>
                                    </div>
                                    <div class="flex-shrink-0">
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <h5 class="mt-3 font-size-15 text-uppercase">Labels</h5>

                    <div class="card p-0 overflow-hidden mt-3 shadow-none">
                        <div class="mail-list">
                            <a href="#" class="border-bottom"><span
                                    class="mdi mdi-arrow-right-drop-circle text-info float-end"></span>Theme Support</a>
                            <a href="#" class="border-bottom"><span
                                    class="mdi mdi-arrow-right-drop-circle text-warning float-end"></span>Freelance</a>
                            <a href="#" class="border-bottom"><span
                                    class="mdi mdi-arrow-right-drop-circle text-primary float-end"></span>Social</a>
                            <a href="#" class="border-bottom"><span
                                    class="mdi mdi-arrow-right-drop-circle text-danger float-end"></span>Friends</a>
                            <a href="#"><span
                                    class="mdi mdi-arrow-right-drop-circle text-success float-end"></span>Family</a>
                        </div>
                    </div>

                    <h5 class="mt-3 font-size-15 text-uppercase">Chat</h5>

                    <div class="card p-0 overflow-hidden mt-3 mb-1 shadow-none">
                        <div class="mail-list">
                            <a href="javascript: void(0);" class="d-flex align-items-start border-bottom">
                                <img class="flex-shrink-0 me-3 rounded-circle" src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                    alt="Generic placeholder image" height="36">
                                <div class="flex-grow-1 chat-user-box">
                                    <p class="user-title m-0">Scott Median</p>
                                    <p class="text-muted mb-0">Hello</p>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="d-flex align-items-start border-bottom">
                                <img class="flex-shrink-0 me-3 rounded-circle" src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                    alt="Generic placeholder image" height="36">
                                <div class="flex-grow-1 chat-user-box">
                                    <p class="user-title m-0">Julian Rosa</p>
                                    <p class="text-muted mb-0">What about our next..</p>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="d-flex align-items-start border-bottom">
                                <img class="flex-shrink-0 me-3 rounded-circle" src="{{ URL::asset('build/images/users/avatar-4.jpg') }}"
                                    alt="Generic placeholder image" height="36">
                                <div class="flex-grow-1 chat-user-box">
                                    <p class="user-title m-0">David Medina</p>
                                    <p class="text-muted mb-0">Yeah everything is fine</p>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="d-flex align-items-start border-bottom">
                                <img class="flex-shrink-0 me-3 rounded-circle" src="{{ URL::asset('build/images/users/avatar-6.jpg') }}"
                                    alt="Generic placeholder image" height="36">
                                <div class="flex-grow-1 chat-user-box">
                                    <p class="user-title m-0">Jay Baker</p>
                                    <p class="text-muted mb-0">Wow that's great</p>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- End Left sidebar -->

        <!-- Right Sidebar -->
        <div class="email-rightbar mb-3">

            <div class="card">
                <div class="card-body">

                    <div class="">
                        <div class="row mb-4">
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
                                <div class="pb-3 pb-xl-0">
                                    <div class="btn-toolbar float-end" role="toolbar">
                                        <div class="btn-group me-2 mb-2 mb-sm-0">
                                            <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                                    class="fa fa-inbox"></i></button>
                                            <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                                    class="fa fa-exclamation-circle"></i></button>
                                            <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                                    class="far fa-trash-alt"></i></button>
                                        </div>
                                        <div class="btn-group me-2 mb-2 mb-sm-0">
                                            <button type="button"
                                                class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-folder"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Updates</a>
                                                <a class="dropdown-item" href="#">Social</a>
                                                <a class="dropdown-item" href="#">Team Manage</a>
                                            </div>
                                        </div>
                                        <div class="btn-group me-2 mb-2 mb-sm-0">
                                            <button type="button"
                                                class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-tag"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Updates</a>
                                                <a class="dropdown-item" href="#">Social</a>
                                                <a class="dropdown-item" href="#">Team Manage</a>
                                            </div>
                                        </div>

                                        <div class="btn-group me-2 mb-2 mb-sm-0">
                                            <button type="button"
                                                class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                More <i class="mdi mdi-dots-vertical ms-2"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Mark as Unread</a>
                                                <a class="dropdown-item" href="#">Mark as Important</a>
                                                <a class="dropdown-item" href="#">Add to Tasks</a>
                                                <a class="dropdown-item" href="#">Add Star</a>
                                                <a class="dropdown-item" href="#">Mute</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0 me-3">
                            <img class="rounded-circle avatar-sm" src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                alt="Generic placeholder image">
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="font-size-14 mb-0">Humberto D. Champion</h5>
                            <small class="text-muted">support@domain.com</small>
                        </div>
                    </div>

                    <h4 class="font-size-16">This Week's Top Stories</h4>

                    <p>Dear Lorem Ipsum,</p>
                    <p>Praesent dui ex, dapibus eget mauris ut, finibus vestibulum enim. Quisque arcu leo, facilisis in
                        fringilla id, luctus in tortor. Nunc vestibulum est quis orci varius viverra. Curabitur dictum
                        volutpat massa vulputate molestie. In at felis ac velit maximus convallis.
                    </p>
                    <p>Sed elementum turpis eu lorem interdum, sed porttitor eros commodo. Nam eu venenatis tortor, id
                        lacinia diam. Sed aliquam in dui et porta. Sed bibendum orci non tincidunt ultrices. Vivamus
                        fringilla, mi lacinia dapibus condimentum, ipsum urna lacinia lacus, vel tincidunt mi nibh sit amet
                        lorem.</p>
                    <p>Sincerly,</p>
                    <hr>

                    <div class="row">
                        <div class="col-xl-2 col-6">
                            <div class="card">
                                <img class="card-img-top img-fluid" src="{{ URL::asset('build/images/small/img-3.jpg') }}"
                                    alt="Card image cap">
                                <div class="py-2 text-center">
                                    <a href="javascript: void(0);" class="fw-medium">Download</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-6">
                            <div class="card">
                                <img class="card-img-top img-fluid" src="{{ URL::asset('build/images/small/img-4.jpg') }}"
                                    alt="Card image cap">
                                <div class="py-2 text-center">
                                    <a href="javascript: void(0);" class="fw-medium">Download</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="javascript: void(0);" class="btn btn-secondary waves-effect mt-4"><i
                            class="mdi mdi-reply me-1"></i> Reply</a>


                </div>
            </div>

        </div> <!-- end Col-9 -->

        </div>
        </div><!-- End row -->


        </div>
        <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- Modal -->
        <div class="modal fade" id="composemodal" tabindex="-1" role="dialog" aria-labelledby="composemodalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="composemodalTitle">New Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="To">
                            </div>

                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Subject">
                            </div>
                            <div class="mb-3">
                                <div id="email-editor"></div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send <i
                                class="fab fa-telegram-plane ms-1"></i></button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <!-- ckeditor -->
        <script src="{{ URL::asset('build/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

        <!-- email editor init -->
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
