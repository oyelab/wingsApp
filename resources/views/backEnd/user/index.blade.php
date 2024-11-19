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
                            <img src="{{ asset('build/images/pattern-bg.jpg') }}" class="profile-img profile-foreground-img rounded-top"
                                style="height: 120px;" alt="">
							<div class="overlay-content rounded-top">
								<div class="user-nav p-3">
									<div class="d-flex justify-content-end">
										<a href="#" class="text-muted font-size-16" title="Edit">
											<i class="bx bx-edit text-white font-size-20"></i>
										</a>
									</div>
								</div>
							</div>
                        </div>
                        <!-- end user-profile-img -->


                        <div class="p-4 pt-0">

                            <div class="mt-n5 position-relative text-center border-bottom pb-3">
                                <img src="{{ asset('build/images/users/avatar-3.jpg') }}" alt=""
                                    class="avatar-xl rounded-circle img-thumbnail">

                                <div class="mt-3">
                                    <h5 class="mb-1">{{ $user->name }}</h5>
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
                                            <td class="text-muted">{{ $user->city }}</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th class="fw-bold">
                                                Zone :</th>
                                            <td class="text-muted">{{ $user->zone }}</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th class="fw-bold">
                                                Area :</th>
                                            <td class="text-muted">{{ $user->area }}</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th class="fw-bold">
                                                Country :</th>
                                            <td class="text-muted">{{ $user->country }}</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th class="fw-bold">Zip :</th>
                                            <td class="text-muted">{{ $user->zip }}</td>
                                        </tr>
                                        <!-- end tr -->

                                        <tr>
                                            <th class="fw-bold">Phone :</th>
                                            <td class="text-muted">{{ $user->phone }}</td>
                                        </tr>
                                        <!-- end tr -->

                                        <tr>
                                            <th class="fw-bold">Email :</th>
                                            <td class="text-muted">{{ $user->email }}</td>
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
                                            <p class="text-muted mb-0">Orders</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-1">
                                            <h5 class="mb-1">5.2k</h5>
                                            <p class="text-muted mb-0">Reviews</p>
                                        </div>
                                    </div>
                                </div>
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
                                    <span>Active Orders</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab">
                                    <span>Active Reviews</span>
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
								
								<div class="mt-4">
									<div class="table-responsive">
										<table class="table table-nowrap table-hover mb-1">
											<thead class="bg-light">
												<tr>
													<th scope="col">Order Date</th>
													<th scope="col">Order Ref</th>
													<th scope="col">Order Address</th>
													<th scope="col">Status</th>
													<th scope="col" style="width: 120px;">Action</th>
												</tr>
											</thead>
											<tbody>
												@forelse ($orders as $index => $order)
													<tr>
														<td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</td>
														<td>
															<a href="#" class="text-body" onclick="copyToClipboard(this, '{{ $order->ref }}')" title="Click to copy">
																#{{ $order->ref }}
															</a>
														</td>
														<td>{{ $order->address }}</td>
														<td>
									
															@switch($order->status)
																@case(0)
																	Pending
																	@break
																@case(1)
																	Completed
																	@break
																@case(2)
																	Processing
																	@break
																@case(3)
																	Shipped
																	@break
																@case(4)
																	Refunded
																	@break
																@case(5)
																	Cancelled
																	@break
															@endswitch

														</td>
														<td>
															<i class="fas fa-eye" title="View Order Details"></i>
															<i class="fas fa-file-invoice ms-2" title="Invoice"></i>
															<i class="fas fa-dollar-sign ms-2" title="Request Refund"></i>
														</td>

													</tr>
												@empty
													<tr>
														<td colspan="9" class="text-center">No orders found.</td>
													</tr>
												@endforelse
											</tbody>
										</table>
									</div>
								</div>

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
                                                        <img src="{{ asset('build/images/users/avatar-2.jpg') }}"
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
                                                        <img src="{{ asset('build/images/users/avatar-3.jpg') }}"
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
                                                        <img src="{{ asset('build/images/users/avatar-6.jpg') }}"
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
                </div>

            </div>

        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
		<script>
			function copyToClipboard(element, text) {
				navigator.clipboard.writeText(text).then(function() {
					// Temporarily change the text to indicate it has been copied
					const originalText = element.textContent;
					element.textContent = 'Copied!';
					element.style.color = 'green'; // Optional: change text color for emphasis

					// Revert back to the original text after a short delay
					setTimeout(() => {
						element.textContent = originalText;
						element.style.color = ''; // Reset color
					}, 1000);
				}).catch(function(err) {
					console.error('Failed to copy: ', err);
				});
			}
		</script>
        <!-- apexcharts -->
        <script src="{{ asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <script src="{{ asset('build/js/pages/profile.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('build/js/app.js') }}"></script>
    @endsection
