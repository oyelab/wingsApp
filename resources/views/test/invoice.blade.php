@extends('frontEnd.layouts.app')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('content')
<div class="container text-center">

	<div class="row align-items-center p-5">
		<!-- Logo in col-4 -->
		<div class="col-md-6">
			<img src="{{ $siteSettings->getImagePath('logo_v1') }}" alt="Logo" class="w-25">
		</div>
		<!-- Phone & Email in col-8 -->
		<div class="col-md-6 text-start">
			<p class="">{{ $siteSettings->phone }}</p>
			<p class="">{{ $siteSettings->address }}</p>
		</div>
	</div>


	<!-- Invoice Title -->
	<div class="title mt-5">
		Invoice - #{{ $order->ref }}
	</div>

	<!-- Customer Details -->
	<table class="table table-bordered mt-5 invoice-table">
		<tr>
			<td class="text-start"><strong>Name:</strong></td>
			<td class="text-start">{{ $order->name }}</td>
			<td class="w-25"></td>
			<td class="text-end"><strong>Bill No:</strong></td>
			<td class="text-start">#ws12345678</td>
		</tr>
		<tr>
			<td class="text-start"><strong>Address:</strong></td>
			<td class="text-start">{{ $order->address }}</td>
			<td></td>
			<td class="text-end"><strong>Date:</strong></td>
			<td class="text-start">{{ $order->tran_date }}</td>
		</tr>
	</table>

	<!-- Item Table -->
	<table class="table table-bordered bg-transparent">
		<thead>
			<tr>
				<th>No.</th>
				<th>Description</th>
				<th>Quantity</th>
				<th class="text-end">Rate</th>
				<th class="text-end">Amount</th>
			</tr>
		</thead>
		<tbody>
			@if ($items->isNotEmpty())
				@foreach ($items as $index => $item)
					<tr>
						<td>{{ $index + 1 }}</td>
						<td>{{ $item['title'] }}</td>
						<td>{{ $item['quantity'] }}</td>
						<td class="text-end">{{ $item['price'] }}/-</td>
						<td class="text-end">{{ $item['fullPrice'] }}/-</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="5" class="text-center">
						<strong>Product may have been deleted</strong>
					</td>
				</tr>
			@endif
			<tr class="blank-row">
				<td colspan="10"></td>
			</tr>
			<tr class="total-row">
				<td colspan="3"></td>
				<td class="text-end"><strong>Total</strong></td>
				<td class="text-end">{{ $order->subtotal }}/-</td>
			</tr>
			<tr class="total-row">
				<td colspan="3"></td>
				<td class="text-end"><strong>Shipping Fee</strong></td>
				<td class="text-end">{{ $order->shipping_charge }}/-</td>
			</tr>

			@if (!empty($order->discount))
				<tr class="discount-row">
					<td colspan="3"></td>
					<td class="text-end"><strong>Product Discount</strong></td>
					<td class="text-end">{{ $order->discount }}/-</td>
				</tr>
			@endif

			@if (!empty($order->voucher))
				<tr class="discount-row">
					<td colspan="3"></td>
					<td class="text-end"><strong>Voucher Discount</strong></td>
					<td class="text-end">{{ $order->voucher }}/-</td>
				</tr>
			@endif

			<tr class="paid-row">
				<td colspan="3"></td>
				<td class="text-end"><strong>Paid</strong></td>
				<td class="text-end">{{ $order->paid }}/-</td>
			</tr>

			<tr>
				<td colspan="3">
					<small>
						<strong>Taka in Words:</strong>
						{{ ucwords(\NumberFormatter::create('en', \NumberFormatter::SPELLOUT)->format($order->unpaid_amount ?? 0)) }}
						Taka Only
					</small>
				</td>
				<td class="text-end"><strong>Due</strong></td>
				<td class="text-end">{{ $order->unpaid_amount !== null ? $order->unpaid_amount . '/-' : 'N/A' }}
				</td>
			</tr>
		</tbody>
	</table>



	<!-- Footer Section -->
	<div class="row align-items-center pb-5">
		<div class="col-md-6">
			<ul class="d-flex align-items-center">
				@foreach ($socialLinks as $link)
					<li class=" ms-2">
						<a href="{{ 'https://' . strtolower($link['platform']) . '.com/' . $link['username'] }}" target="_blank">
							<i class="social-icon {{ $iconMapping[strtolower($link['platform'])] }}"></i>
						</a>
					</li>
				@endforeach
			</ul>
		</div>

		<!-- Signature Section -->
		<div class="col-md-6">
			<img src="{{ asset('images/invoice-signature.png') }}" alt="Signature" width="100" />
			<hr />
			<p><strong>Authorised Signature</strong></p>
		</div>
	</div>

</div>
	
@endsection