@extends('backEnd.layouts.master')
@section('title')
    Cart
@endsection
@section('page-title')
    Cart
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
		<div class="col-xl-8">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<!-- Begin form for updating the order -->
						<form action="{{ route('orders.update', $order) }}" method="POST">
							@csrf
							@method('PUT') <!-- Use PUT or PATCH depending on your route definition -->
							<table class="table align-middle mb-0">
								<thead class="table-light">
									<tr>
										<th>Product</th>
										<th>Product Name</th>
										<th>Size</th>
										<th>Quantity</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($order->products as $product)
									<tr>
										<th>
											<img 
												src="{{ asset('build/images/product/img-1.png') }}" 
												alt=""
												class="avatar-lg rounded p-1"
											>
										</th>
										<td>
											<div>
												<h5 class="font-size-16">
													<a href="#" class="text-body">{{ $product->title }}</a>
												</h5>
												<p class="mb-0 mt-1">Color : <span class="fw-medium">Gray</span></p>
											</div>
										</td>
										<td>
											<div class="d-inline-flex">
												<select class="form-select form-select-sm w-sm" name="products[{{ $product->pivot->product_id }}][size_id]">
													@foreach ($sizes as $size)
														<option value="{{ $size->id }}" {{ $product->pivot->size_id == $size->id ? 'selected' : '' }}>
															{{ $size->name }}
														</option>
													@endforeach
												</select>
											</div>
										</td>
										<td>
											<div class="d-inline-flex">
												<input class="form-control form-control-sm w-sm" type="number" name="{{ $product->pivot->size_id }}" value="{{ $product->pivot->quantity }}">
											</div>
										</td>
										<td>
											<ul class="list-inline mb-0 d-flex align-items-center">
												<li class="list-inline-item"> <!-- Added margin to the right -->
													<i class="text-primary bx bx-check font-size-18"></i>
												</li>
												<li class="list-inline-item">
													<i class="text-danger bx bx-trash-alt font-size-18"></i>
												</li>
											</ul>
										</td>

									</tr>
									@endforeach
								</tbody>
							</table>
							<div class="row my-4">
								<div class="col-sm-6">
									<a href="{{ route('orders.index') }}" class="btn btn-link text-muted">
										<i class="mdi mdi-arrow-left me-1"></i> Order Lists
									</a>
								</div> <!-- end col -->
								<div class="col-sm-6">
									<div class="text-sm-end mt-2 mt-sm-0">
										<button type="submit" class="btn btn-success">
											<i class="mdi mdi-cart-outline me-1"></i> Update Order
										</button>
									</div>
								</div> <!-- end col -->
							</div> <!-- end row -->
						</form>
						<!-- End form for updating the order -->
					</div>
				</div>
			</div>
		</div>


            <div class="col-xl-4">
                <div class="mt-5 mt-lg-0">
                    <div class="card">
                        <div class="card-header bg-transparent border-bottom py-3 px-4">
                            <h5 class="font-size-16 mb-0">Order Ref <span class="float-end">#{{ $order->ref }}</span></h5>
                        </div>
                        <div class="card-body p-4 pt-2">

                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Sub Total :</td>
                                            <td class="text-end">$ 780</td>
                                        </tr>
                                        <tr>
                                            <td>Discount : </td>
                                            <td class="text-end">- $ 78</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping Charge :</td>
                                            <td class="text-end">$ 25</td>
                                        </tr>
                                        <tr>
                                            <td>Estimated Tax : </td>
                                            <td class="text-end">$ 18.20</td>
                                        </tr>
                                        <tr class="bg-light">
                                            <th>Total :</th>
                                            <td class="text-end">
                                                <span class="fw-bold">
                                                    $ 745.2
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
	<script>
		
	</script>
        <!-- App js -->
        <script src="{{ asset('build/js/app.js') }}"></script>
    @endsection
