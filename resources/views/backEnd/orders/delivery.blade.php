@extends('backEnd.layouts.master')
@section('title')
    Delivery 
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
						@if(session('response'))
							<div class="alert alert-{{ session('response')['type'] ?? 'info' }} alert-dismissible fade show" role="alert">
								<strong>{{ session('response')['message'] }}</strong><br>
								
								{{-- If there's additional data in the response, display it --}}
								@if(isset(session('response')['data']))
									<ul>
										@foreach(session('response')['data'] as $key => $value)
											<li><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</li>
										@endforeach
									</ul>
								@endif

								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif
					<div class="table">
						<!-- Begin form for updating the order -->
						<form action="{{ route('create.order', $order) }}" method="POST">
							@csrf
							<input type="hidden" name="item_type" value="2">
							<input type="hidden" name="item_weight" value="0.5">

							<table class="table align-middle mb-0">
								<thead class="table-light">
									<tr>
										<th colspan="4">Update Customer Delivery information Here:</th>
									</tr>
								</thead>
								<tbody>
								<tr>
									<th>
										<label for="store_id">Store ID:</label>
									</th>
									<th>
										<label for="store_id">130776</label>
										<input type="hidden" name="store_id" value="130776">
									</th>
									<td>
										<label for="order_ref">Order Ref:</label>
									</td>
									<td>
										<label for="order_ref">{{ $order->ref }}</label>
										<input type="hidden" name="order_ref" value="{{ $order->ref }}">
									</td>
								</tr>
								<tr>
									<td>
										<label for="recipient_name">Customer Details:</label>
									</td>
									<td>
										<label for="recipient_name">{{ $order->name }}</label>
										<input type="hidden" name="recipient_name" value="{{ $order->name }}">
									</td>
									<td>
										<label for="recipient_phone">{{ $order->phone }}</label>
										<input type="hidden" name="recipient_phone" value="{{ $order->phone }}">
									</td>
									<td>
										<label for="recipient_address">{{ $order->address }}</label>
										<input type="hidden" name="recipient_address" value="{{ $order->address }}">
									</td>
								</tr>
								<tr>
									<td>
										<label for="delivery_location">Delivery Location:</label>
									</td>
									<td>
										<select class="form-select form-select-sm w-sm" id="recipient_city" name="recipient_city" required onchange="fetchZones()">
											<option value="">Select City</option>
										</select>
									</td>
									<td>
										<select class="form-select form-select-sm w-sm" id="recipient_zone" name="recipient_zone" required onchange="fetchAreas()">
											<option value="">Select Zone</option>
										</select>
									</td>
									<td>
										<select class="form-select form-select-sm w-sm" id="recipient_area" name="recipient_area">
											<option value="">Select Area</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<label for="delivery_type">Delivery Type:</label>
									</td>
									<td>
										<select class="form-select form-select-sm w-sm" id="delivery_type" name="delivery_type" required>
											<option value="">Select Delivery Type</option>
											<option value="12">On Demand</option>
											<option value="48" selected>Normal</option>
										</select>
									</td>
									<td>
										<label for="special_instruction">Special Instruction:</label>
									</td>
									<td>
										<input class="form-control form-control-sm w-sm" type="text" name="special_instruction" id="special_instruction">
									</td>
								</tr>
								<tr>
									<td>
										<label for="item_quantity">Item Quantity:</label>
									</td>
									<td>
										<label for="item_quantity">{{ $totalQuantity }}</label>
										<input type="hidden" name="item_quantity" id="item_quantity" value="{{ $totalQuantity }}">
									</td>
									<td>
										<label for="amount_to_collect">Amount to Collect:</label>
									</td>
									<td>
										<label for="amount_to_collect">{{ $transaction->unpaid }}</label>
										<input type="hidden" name="amount_to_collect" id="amount_to_collect" value="{{ $transaction->unpaid }}">
									</td>
								</tr>
								<tr>
									<td>
										<label for="item_description">Item Description:</label>
									</td>
									<td colspan="3">
										<textarea class="form-control form-control-sm w-sm" name="item_description" id="item_description"></textarea>
									</td>
								</tr>
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
											<i class="mdi mdi-cart-outline me-1"></i>Send to Pathao
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
                            <h5 class="font-size-16 mb-0">Order Ref: <span class="float-end">#{{ $order->ref }}</span></h5>
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
                                            <td class="text-end">{{ $delivery->delivery_fee }}</td>
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
    // Example values from the $delivery object
    const selectedCityId = "{{ $delivery->recipient_city }}"; // Assuming this is the city_id
    const selectedZoneId = "{{ $delivery->recipient_zone }}"; // Assuming this is the zone_id
    const selectedAreaId = "{{ $delivery->recipient_area }}"; // Assuming this is the area_id, could be null

    async function fetchCities() {
        const citySelect = document.getElementById("recipient_city");

        try {
            const response = await fetch('/cities');
            const result = await response.json();

            if (Array.isArray(result.data)) {
                result.data.forEach(city => {
                    const isSelected = selectedCityId && city.city_id == selectedCityId ? 'selected' : '';
                    citySelect.innerHTML += `<option value="${city.city_id}" ${isSelected}>${city.city_name}</option>`;
                });

                // If the selected city ID exists, trigger zone fetch
                if (selectedCityId) {
                    fetchZones(); // Fetch zones for the selected city
                }
            } else {
                console.error('Data format is unexpected:', result);
            }
        } catch (error) {
            console.error('Error fetching cities:', error);
        }
    }

    async function fetchZones() {
        const cityId = document.getElementById("recipient_city").value;
        const zoneSelect = document.getElementById("recipient_zone");
        const areaSelect = document.getElementById("recipient_area");

        // Reset zone and area dropdowns
        zoneSelect.innerHTML = '<option value="">Select Zone</option>';
        areaSelect.innerHTML = '<option value="">Select Area</option>';

        if (!cityId) return;

        try {
            const response = await fetch(`/zones/${cityId}`);
            const data = await response.json();

            if (data && Array.isArray(data.data)) {
                data.data.forEach(zone => {
                    const isSelected = selectedZoneId && zone.zone_id == selectedZoneId ? 'selected' : '';
                    zoneSelect.innerHTML += `<option value="${zone.zone_id}" ${isSelected}>${zone.zone_name}</option>`;
                });

                // If the selected zone ID exists, trigger area fetch
                if (selectedZoneId) {
                    fetchAreas(); // Fetch areas for the selected zone
                }
            }
        } catch (error) {
            console.error('Error fetching zones:', error);
        }
    }

    async function fetchAreas() {
        const zoneId = document.getElementById("recipient_zone").value;
        const areaSelect = document.getElementById("recipient_area");

        // Reset area dropdown
        areaSelect.innerHTML = '<option value="">Select Area</option>';

        if (!zoneId) return;

        try {
            const response = await fetch(`/areas/${zoneId}`);
            const data = await response.json();

            if (data && Array.isArray(data.data)) {
                data.data.forEach(area => {
                    const isSelected = selectedAreaId && area.area_id == selectedAreaId ? 'selected' : '';
                    areaSelect.innerHTML += `<option value="${area.area_id}" ${isSelected}>${area.area_name}</option>`;
                });
            }
        } catch (error) {
            console.error('Error fetching areas:', error);
        }
    }

    // Call fetchCities when the page loads
    window.onload = fetchCities; // Fetch cities on page load

    // Example: Call fetchZones when the city is changed
    document.getElementById("recipient_city").addEventListener("change", fetchZones);

    // You can similarly call fetchAreas when the zone is changed
    document.getElementById("recipient_zone").addEventListener("change", fetchAreas);
</script>



    @endsection
