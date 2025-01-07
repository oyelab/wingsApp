<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Invoice Id: #{{ $order->ref }}</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">


	<style>
		/* @import url("https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap"); */

		html, body {
			width: 210mm;
			height: 297mm;
			position: relative;
			background: #dddddd;
			margin: 0 auto !important;
			font-family: 'Manrope', sans-serif; /* Apply Manrope font */
		}

		.bengali-text {
			font-family: 'Noto Sans Bengali', sans-serif;
		}

		.fs-5 {
			font-weight: 600;
			font-size: 2rem; /* Adjust this value as needed */
		}

		.signature {
			margin-left: 0; /* Ensures no extra space on the left */
		}

		footer {
			width: 100%;
		}
	</style>

</head>

<body>
	<div class="container">
		<div class="row d-flex align-items-center">
			<!-- Logo in col-4 -->
			<div class="col-md-4 mb-5">
				<img src="https://wingssportswear.shop/storage/settings/logo-dark.svg" alt="Logo" class="w-25">
			</div>
			<!-- Phone & Email in col-8 -->
			<div class="col-md-8 d-flex">
				<p class="">{{ $siteSettings->phone }}</p>
				<p class="">{{ $siteSettings->address }}</p>
			</div>
		</div>


		<!-- Invoice Title -->
		<div class="text-center pt-5">
			<strong class="fs-5">Invoice</strong>
		</div>

		<!-- Customer Details -->
		<table class="table table-responsive table-bordered mt-5">
			<tr>
				<td><strong>Name:</strong></td>
				<td style="{{ preg_match('/[^\x00-\x7F]/', $order->name) ? 'font-family: Noto Sans Bengali, sans-serif;' : '' }}">
					{{ $order->name }}
				</td>
				<td><strong>Bill No:</strong></td>
				<td>#{{ $order->ref }}</td>
			</tr>
			<tr>
				<td><strong>Address:</strong></td>
				<td style="{{ preg_match('/[^\x00-\x7F]/', $order->address) ? 'font-family: Noto Sans Bengali, sans-serif;' : '' }}">
					<td>{{ $order->address }}</td>
				</td>
				<td><strong>Date:</strong></td>
				<td>{{ \Carbon\Carbon::parse($order->tran_date)->format('d/m/Y') }}</td>
			</tr>
		</table>

		<!-- Item Table -->
		<table class="table table-responsive table-bordered mt-5">
			<thead>
				<tr>
					<th class="pe-2">No.</th>
					<th class="pe-2">Description</th>
					<th class="text-end">Quantity</th>
					<th class="w-25 text-end pe-2">Rate</th>
					<th class="w-25 text-end">Amount</th>
				</tr>

			</thead>
			<tbody>
				@foreach ($items as $index => $item)
					<tr>
						<td>{{ $index + 1 }}</td>
						<td>{{ $item['title'] }}</td>
						<td class="text-center">{{ $item['quantity'] }}</td>
						<td class="text-end">{{ $item['sale'] }}/-</td>
						<td class="text-end">{{ $item['fullPrice'] }}/-</td>
					</tr>
				@endforeach
				<tr style="height: 50px;">
					<td colspan="3"></td>
					<td></td>
					<td></td>
				</tr>


				<tr class="total-row">
					<td colspan="3"></td>
					<td class="text-end"><strong>Order Total</strong></td>
					<td class="text-end">{{ $order->order_total }}/-</td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td class="text-end"><strong>Shipping Fee</strong></td>
					<td class="text-end">{{ $order->shipping_charge }}/-</td>
				</tr>
				@if ($order->discount)
					<tr>
						<td colspan="3"></td>
						@if($order->voucher && $order->voucher > 0)
							<td class="text-end"><strong>Voucher Discount(-)</strong></td>
							<td class="text-end">{{ $order->voucher }}/-</td>
						@endif
					</tr>
				@endif
				<tr>
					<td colspan="3"></td>
					<td class="text-end"><strong>Paid(-)</strong></td>
					<td class="text-end">{{ $order->paid }}/-</td>
				</tr>
				<tr>
					<td colspan="3">
						<small>
							<strong>Taka in Words:
								@if ($order->unpaid_amount !== null && $order->unpaid_amount > 0)
									{{ ucwords(\NumberFormatter::create('en', \NumberFormatter::SPELLOUT)->format($order->unpaid_amount ?? 0)) }}
									Taka Only
								@else
									<span>The order is fully paid</span>
								@endif
							</strong>
						</small>
					</td>
					<td class="text-end"><strong>Due</strong></td>
					<td class="text-end">{{ $order->unpaid_amount !== null ? $order->unpaid_amount . '/-' : 'N/A' }}
					</td>
				</tr>
			</tbody>
		</table>

		<div class="mt-5">
			@php
				// Specify the platforms you want to display
				$allowedPlatforms = ['Facebook', 'Instagram'];

				// Filter the socialLinks to include only allowed platforms
				$filteredLinks = collect($socialLinks)->filter(function ($link) use ($allowedPlatforms) {
					return in_array($link['platform'], $allowedPlatforms);
				});
			@endphp

			<div class="mt-5">
				<ul class="d-flex list-unstyled">
					@foreach ($filteredLinks as $link)
						<li>
							{{ $link['platform'] }}/ 
							<a href="{{ 'https://' . strtolower($link['platform']) . '.com/' . $link['username'] }}"
								target="_blank"
								class="d-inline-flex">
								<i class="social-icon {{ $iconMapping[strtolower($link['platform'])] }} me-1"></i>
								{{ $link['username'] }}
							</a>
						</li>
					@endforeach
					<li>
						Website: 
						<a href="{{ $siteUrl }}" target="_blank"
							class="d-inline-flex">
							<i class="bi bi-link"></i> {{ $siteUrl }}
						</a>
					</li>
				</ul>
			</div>

			<div class="col-md-4">
				<div class="mb-0">
					<img class="signature mb-0" src="https://wingssportswear.shop/images/invoice-signature.png" alt="">
				</div>
				<div>
					<p>Authorized Signature</p>
				</div>
			</div>
			</div>
		</div>
	</div>
</body>

</html>