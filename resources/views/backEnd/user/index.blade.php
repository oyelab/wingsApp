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
										<a href="#" class="text-muted font-size-16" data-bs-toggle="modal" data-bs-target="#editModal" title="Edit">
											<i class="bx bx-edit text-white font-size-20"></i>
										</a>
									</div>
								</div>
							</div>
                        </div>
                        <!-- end user-profile-img -->

						<!-- Modal -->
						<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<!-- Modal Form for User Profile -->
										<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
											@csrf
											@method('PUT')
											<div class="modal-body">
												<div class="mb-3">
													<label for="name" class="form-label">Name</label>
													<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', auth()->user()->name) }}">
													@error('name')
														<div class="invalid-feedback">{{ $message }}</div>
													@enderror
												</div>

												<div class="mb-3">
													<label for="email" class="form-label">Email</label>
													<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', auth()->user()->email) }}">
													@error('email')
														<div class="invalid-feedback">{{ $message }}</div>
													@enderror
												</div>

												<div class="mb-3">
													<label for="phone" class="form-label">Phone</label>
													<input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}">
													@error('phone')
														<div class="invalid-feedback">{{ $message }}</div>
													@enderror
												</div>

												<div class="mb-3">
													<label for="city" class="form-label">City</label>
													<input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', auth()->user()->city) }}">
													@error('city')
														<div class="invalid-feedback">{{ $message }}</div>
													@enderror
												</div>

												<div class="mb-3">
													<label for="zone" class="form-label">Zone</label>
													<input type="text" class="form-control @error('zone') is-invalid @enderror" id="zone" name="zone" value="{{ old('zone', auth()->user()->zone) }}">
													@error('zone')
														<div class="invalid-feedback">{{ $message }}</div>
													@enderror
												</div>

												<div class="mb-3">
													<label for="area" class="form-label">Area</label>
													<input type="text" class="form-control @error('area') is-invalid @enderror" id="area" name="area" value="{{ old('area', auth()->user()->area) }}">
													@error('area')
														<div class="invalid-feedback">{{ $message }}</div>
													@enderror
												</div>

												<div class="mb-3">
													<label for="country" class="form-label">Country</label>
													<input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" value="{{ old('country', auth()->user()->country) }}">
													@error('country')
														<div class="invalid-feedback">{{ $message }}</div>
													@enderror
												</div>

												<div class="mb-3">
													<label for="zip" class="form-label">Zip Code</label>
													<input type="text" class="form-control @error('zip') is-invalid @enderror" id="zip" name="zip" value="{{ old('zip', auth()->user()->zip) }}">
													@error('zip')
														<div class="invalid-feedback">{{ $message }}</div>
													@enderror
												</div>

												<div class="mb-3">
													<label for="avatar" class="form-label">Avatar</label>
													<input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar">
													@error('avatar')
														<div class="invalid-feedback">{{ $message }}</div>
													@enderror
												</div>
											</div>

											<div class="modal-footer">
												<button type="submit" class="btn btn-primary">Update</button>
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
											</div>
										</form>

									</div>
								</div>
							</div>
						</div>



                        <div class="p-4 pt-0">

                            <div class="mt-n5 position-relative text-center border-bottom pb-3">
                                <img src="{{ $user->avatarPath }}" alt=""
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
                                            <h5 class="mb-1">{{ $user->ordersCount }}</h5>
                                            <p class="text-muted mb-0">Orders</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-1">
                                            <h5 class="mb-1">{{ $user->reviewsCount }}</h5>
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
                                <a class="nav-link" data-bs-toggle="tab" href="#overview" role="tab">
                                    <span>Active Orders</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#messages" role="tab">
                                    <span>Active Reviews</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Tab content -->
                <div class="tab-content">
                    <div class="tab-pane" id="overview" role="tabpanel">
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
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane active" id="messages" role="tabpanel">
                        <div class="card">
                            <div class="card-body">

                                <div class="py-2">

                                    <div class="mx-n4 px-4" data-simplebar style="max-height: 360px;">
									@foreach ($reviews as $review)
										<div class="border-bottom pb-3">
											<p class="float-sm-end text-muted font-size-13">{{ $review->created_at->format('d M, Y') }}</p>
											
											<!-- Star rating badge -->
											<div class="d-inline-flex align-items-center mb-2" id="rating-display-{{ $review->id }}">
												<div class="badge bg-success"><i class="mdi mdi-star"></i>Rating {{ $review->rating }}</div>
											</div>

											<p class="text-muted mb-4">{{ $review->content }}</p>
											
											<div class="flex">
												<strong>Review Added to >> &nbsp;</strong>
												@if ($review->products->isEmpty())
													<span>Site</span>
												@else
													@foreach ($review->products as $product)
														<span>{{ $product->title }}</span>
														@if (!$loop->last),@endif <!-- Optional: Adds a comma between product titles, except after the last one -->
													@endforeach
												@endif

											</div>
										</div>
									@endforeach

                                    </div>

                                    <div class="mt-2">
                                       
										<form action="{{ route('reviews.store') }}" method="POST">
											@csrf
											<div class="border rounded mt-4 bg-light">
												<div class="ms-3 d-flex align-items-center" role="group">
													<div id="basic-rater" class="me-2"></div> <!-- Add margin to separate the stars and text -->
													<span class="p-3">
														<strong>Rate from 1 to 5 stars to share your opinion.</strong>
													</span>
												</div>

												<!-- Hidden input to store the star rating -->
												<input type="hidden" name="rating" id="ratingValue">

												<textarea rows="3" class="form-control border-0 resize-none" placeholder="Write Your Review..." name="content"></textarea>
											</div>

											<!-- Error message display -->
											@if ($errors->any())
												<div class="mt-2 ms-3 text-danger">
													@foreach ($errors->all() as $error)
														<p class="mb-0">{{ $error }}</p>
													@endforeach
												</div>
											@endif

											<div class="text-end mt-3">
												<button type="submit" class="btn btn-success w-sm text-truncate ms-2">Submit Review
													<i class="bx bx-send ms-2 align-middle"></i>
												</button>
											</div>
										</form>

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
		
		<script src="{{ asset('build/libs/rater-js/index.js') }}"></script>


        <script src="{{ asset('build/js/pages/profile.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('build/js/app.js') }}"></script>
        <!-- rating init -->

		<script>
			// Define the initial rating value
			var initialRating = 4; // You can change this to 5 if needed

			// Initialize raterJs
			var basicRating = raterJs({
				starSize: 22,
				rating: initialRating, // Use the variable for initial display
				element: document.querySelector("#basic-rater"),
				rateCallback: function rateCallback(rating, done) {
					// Set the rating value to the hidden input field when a user interacts
					document.getElementById("ratingValue").value = rating;
					this.setRating(rating); // Reflects the selected rating in the widget
					done();
				}
			});

			// Set the initial value of the hidden input field using the variable
			document.getElementById("ratingValue").value = initialRating;
		</script>
    @endsection
