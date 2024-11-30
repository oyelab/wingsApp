<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Id: #{{ $order->ref }}</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ public_path('frontEnd/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ public_path('frontEnd/css/style.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap");

		:root {
			--wings-primary: #1e1e1e;
			--wings-secondary: #f2f1ed;
			--wings-off: #858585;
			--wings-light: #dddddd;
			--wings-alternative: #78be20;
			--wings-white: #fff;
			--wings-black: #000;
			--wings-font: "Manrope", sans-serif;
		}

        @page {
            size: A4;
            margin: 0; /* Remove any margin to ensure no extra space at the top */
        }

        html, body {
			width: 210mm;
            height: 297mm;
			position: relative;
            background: url('{{ public_path("images/invoice-template.png") }}') no-repeat center center;
            background-size: cover;
			margin: 0 auto !important;
			padding: 0 !important;
        }

        .invoice-box {
            margin: 0 auto;
            padding-top: 0; /* Ensure no padding at the top */
        }

        .invoice {
            padding: 11mm;
            margin-top: 0; /* Ensure no margin at the top */
        }
		.info {
			display: flex; /* Replicates d-flex */
			justify-content: right; /* Replicates justify-content-center */
			gap: 10px; /* Adds spacing between the child elements */
			margin-top: 15px; /* Optional: Adjust margin as needed */
			margin-right: -50px;
			text-align: right; /* Optional: Adjust margin as needed */
		}

		.info p {
			margin: 0; /* Removes default margin from <p> elements */
			display: flex; /* Ensures proper alignment of icons and text */
		}


        .table thead {
            display: table-header-group;
        }

        .table tfoot {
            display: table-footer-group;
        }

        .page-break {
            page-break-before: always;
        }

        .btn {
            display: none;
        }

        .background-transparent {
            background: transparent;
        }

        footer {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 50px 20px;
            font-size: 12px;
            color: var(--wings-primary);
			margin-top: 100px;
        }

        .link-custom {
            color: var(--wings-primary);
            text-decoration: none;
            transition: color 0.3s ease, color 0.3s ease;
        }

        .link-custom:hover {
            color: var(--wings-alternative);
            text-decoration: none;
        }

        @media screen {
            .btn {
                display: inline-block;
            }
        }
    </style>
</head>

<body>
	<div class="container">
		<div class="invoice-box">
			<div class="invoice">
			<!-- Contact Details -->
			<div class="row">
				<div class="row info"> <!-- Custom CSS class -->
					<p class="col-6">
						{{ $siteSettings->address }}
					</p>
					<p class="col-6">
						{{ $siteSettings->phone }}
					</p>
				</div>
			</div>


				<!-- Invoice Title -->
				<div class="text-center pt-5">
					<h3>Invoice</h3>
				</div>

				<!-- Customer Details -->
				<table class="table table-responsive table-bordered background-transparent mt-5">
					<tr>
						<td><strong>Name:</strong></td>
						<td>{{ $order->name }}</td>
						<td><strong>Bill No:</strong></td>
						<td>#{{ $order->ref }}</td>
					</tr>
					<tr>
						<td><strong>Address:</strong></td>
						<td>{{ $order->address }}</td>
						<td><strong>Date:</strong></td>
						<td>{{ \Carbon\Carbon::parse($order->tran_date)->format('d/m/Y') }}</td>
					</tr>
				</table>

				<!-- Item Table -->
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No.</th>
							<th>Description</th>
							<th>Quantity</th>
							<th class="w-25 text-center">Rate</th>
							<th class="text-center">Amount</th>
						</tr>

					</thead>
					<tbody>
						@foreach ($items as $index => $item)
							<tr>
								<td>{{ $index + 1 }}</td>
								<td>{{ $item['title'] }}</td>
								<td>{{ $item['quantity'] }}</td>
								<td class="text-end">{{ $item['price'] }}/-</td>
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
							<td class="text-end"><strong>Total</strong></td>
							<td class="text-end">{{ $order->subtotal }}/-</td>
						</tr>
						<tr>
							<td colspan="3"></td>
							<td class="text-end"><strong>Shipping Fee</strong></td>
							<td class="text-end">{{ $order->shipping_charge }}/-</td>
						</tr>
						@if ($order->discount)
							<tr>
								<td colspan="3"></td>
								<td class="text-end"><strong>Discount</strong></td>
								<td class="text-end">{{ $order->discount }}/-</td>
							</tr>
						@endif
						<tr>
							<td colspan="3"></td>
							<td class="text-end"><strong>Paid</strong></td>
							<td class="text-end">{{ $order->paid }}/-</td>
						</tr>
						<tr>
							<td colspan="3">
								<small><strong>Taka in Words:</strong> {{ ucwords(\NumberFormatter::create('en', \NumberFormatter::SPELLOUT)->format($order->unpaid_amount ?? 0)) }} Taka Only</small>
							</td>
							<td class="text-end"><strong>Due</strong></td>
							<td class="text-end">{{ $order->unpaid_amount !== null ? $order->unpaid_amount . '/-' : 'N/A' }}</td>
						</tr>
					</tbody>
				</table>

				<footer class="mt-auto">
					@php
						// Specify the platforms you want to display
						$allowedPlatforms = ['Facebook', 'Instagram'];

						// Filter the socialLinks to include only allowed platforms
						$filteredLinks = collect($socialLinks)->filter(function ($link) use ($allowedPlatforms) {
							return in_array($link['platform'], $allowedPlatforms);
						});
					@endphp

					<div class="row">
						<ul class="d-flex align-items-center list-unstyled justify-content-start">
							@foreach ($filteredLinks as $link)
								<li class="">
									<a href="{{ 'https://' . strtolower($link['platform']) . '.com/' . $link['username'] }}" 
									target="_blank" 
									class="d-inline-flex align-items-center px-2 py-1 link-custom rounded text-decoration-none">
										<i class="social-icon {{ $iconMapping[strtolower($link['platform'])] }} me-1"></i>
										{{ $link['username'] }}
									</a>
								</li>
							@endforeach
							<li class="">
								<a href="{{ $siteUrl }}" target="_blank" 
								class="d-inline-flex align-items-center px-2 py-1 link-custom rounded text-decoration-none">
									<i class="bi bi-link me-1"></i> {{ $siteUrl }}
								</a>
							</li>
						</ul>
					</div>
				</footer>
			</div>
		</div>
	</div>
</body>
</html>
