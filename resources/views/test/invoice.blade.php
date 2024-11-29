@extends('frontEnd.layouts.app')
@section('css')
<style>
	body {
		font-family: var(--wings-font);
		background-color: var(--wings-light);
		color: var(--wings-primary);
	}

	.invoice-box {
		max-width: 800px;
		height: 1000px; /* Fixed height */
		margin: auto;
		padding: 20px;
		border: 2px solid var(--wings-alternative);
		border-radius: 10px;
		background: linear-gradient(135deg, rgba(221, 221, 221, 0.2), rgba(120, 190, 32, 0.2)); /* Gradient with 20% opacity */
		box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
		overflow-y: auto; /* Scrollable if content exceeds height */
		position: relative; /* Ensures the pseudo-element is positioned correctly */
	}


	.bg-rectangle {
		background-color: var(--wings-alternative); /* Rectangle background color */
		border-radius: 5px;
		padding: 15px; /* Added padding for better spacing */
	}

	.bg-rectangle p {
		margin: 0;
		font-size: 1rem; /* Adjust font size */
	}

	.bg-rectangle i {
		font-size: 1.2rem; /* Icon size */
	}

	.text-center img {
		max-width: 100px; /* Restrict signature image width */
	}

	.text-center hr {
		margin: 15px 0; /* Adjust margin around horizontal line */
	}


	.invoice-title {
		font-size: 2rem;
		font-weight: bold;
		margin: 20px 0;
		text-align: center;
	}

	.text-right {
		text-align: right;
	}

	.table th,
	.table td {
		vertical-align: middle;
		text-align: center;
		background-color: transparent !important; /* Remove background */
		border-color: var(--wings-light) !important; /* Optional: set border color to match your theme */
	}

	.table td.text-right {
		text-align: right;
		/* Ensure right-alignment for price columns */
	}

	.blank-row {
		height: 50px;
		/* Fixed size for the blank row */
	}

	.taka-in-words {
		font-size: 0.85rem;
		/* Smaller font size for Taka in words */
		color: var(--wings-off);
	}

	.signature-container {
		display: flex;
		justify-content: space-between;
		align-items: flex-end;
		margin-top: 20px;
	}

	.disclaimer {
		margin-top: 20px;
		font-size: 0.9rem;
		color: var(--wings-off);
		text-align: center;
	}

	.signature-container {
		padding: 20px;
	}



</style>
@endsection
@section('content')
<div class="invoice-box mt-4 mb-4">
	<!-- Header Section -->
	<div class="row">
		<div class="col-12 d-flex justify-content-between align-items-center">
			<!-- Logo or SVG area (same as before) -->
			<div class="ms-5">
				<svg width="183" height="77" viewBox="0 0 183 77" fill="none" xmlns="http://www.w3.org/2000/svg">
					<g clip-path="url(#clip0_816_1318)">
						<path
							d="M47.72 28.39L4.08 2.43L0 0L2.04 5.86L3.81 10.96C5.01 14.4 7.38 17.31 10.51 19.18L38.03 35.55C40.24 36.87 40.97 39.72 39.65 41.94L10.88 24.82L8.03 23.13L9.45 27.22L11.55 33.27C12.75 36.71 15.12 39.62 18.25 41.49L29.99 48.47C32.34 49.87 33.11 52.91 31.71 55.26L15.92 45.87L23.01 66.25C23.59 67.93 24.75 69.34 26.27 70.25C29.85 72.38 34.47 71.2 36.6 67.63L40.75 60.65L43.28 56.39L48.67 47.33L51.05 43.33L56.73 33.78L47.69 28.4L47.72 28.39Z"
							fill="#231F20" />
						<path
							d="M94.0504 59.52H87.3304C86.5904 59.52 86.3504 58.92 86.8004 58.19L95.1904 44.19C95.6304 43.45 96.5904 42.86 97.3204 42.86H104.04C104.78 42.86 105.02 43.46 104.58 44.19L96.1904 58.19C95.7504 58.93 94.7904 59.52 94.0604 59.52"
							fill="#231F20" />
						<path
							d="M105.41 40.55H98.6898C97.9498 40.55 97.7098 39.95 98.1598 39.22L100.65 35.06C101.09 34.32 102.05 33.73 102.78 33.73H109.5C110.24 33.73 110.48 34.33 110.04 35.06L107.55 39.22C107.11 39.96 106.15 40.55 105.42 40.55"
							fill="#231F20" />
						<path
							d="M133.65 33.72H114.85C114.11 33.72 113.16 34.32 112.72 35.05L98.8704 58.18C98.4304 58.92 98.6704 59.51 99.4104 59.51H106.14C106.88 59.51 107.83 58.91 108.27 58.18L120.71 37.42C121.15 36.68 122.1 36.09 122.84 36.09C123.58 36.09 123.82 36.69 123.38 37.42L110.94 58.18C110.5 58.92 110.74 59.51 111.48 59.51H118.22C118.96 59.51 119.91 58.91 120.35 58.18L134.2 35.05C134.64 34.31 134.4 33.72 133.66 33.72"
							fill="#231F20" />
						<path
							d="M97.4001 33.72H90.6601C89.9201 33.72 88.9701 34.32 88.5301 35.05L76.0801 55.84C75.6401 56.58 74.6801 57.17 73.9501 57.17C73.2201 57.17 72.9701 56.57 73.4201 55.84L85.8701 35.05C86.3101 34.31 86.0701 33.72 85.3301 33.72H78.6101C77.8701 33.72 76.9201 34.32 76.4801 35.05L64.0301 55.84C63.5901 56.58 62.6401 57.17 61.9001 57.17C61.1601 57.17 60.9201 56.57 61.3701 55.84L73.8201 35.05C74.2601 34.31 74.0201 33.72 73.2901 33.72H66.5701C65.8301 33.72 64.8801 34.32 64.4401 35.05L59.7601 42.86C58.7301 44.57 58.2401 46.24 58.3501 47.66L59.1701 58.92C59.2001 59.29 59.4801 59.51 59.9201 59.51H81.9701C82.7101 59.51 83.6601 58.91 84.1001 58.18L97.9601 35.05C98.4001 34.31 98.1601 33.72 97.4201 33.72"
							fill="#231F20" />
						<path
							d="M165.06 43.88L164.78 44.35C164.72 44.45 164.68 44.54 164.65 44.63L165.27 43.6C165.19 43.69 165.12 43.78 165.06 43.88Z"
							fill="#231F20" />
						<path
							d="M178.62 41.45L182.46 35.04C182.9 34.31 182.66 33.71 181.93 33.71H163.09C162.36 33.71 161.41 34.3 160.97 35.04L154.12 46.47C153.68 47.2 153.92 47.79 154.65 47.79H164.08C164.81 47.79 165.05 48.38 164.61 49.12L164.46 49.36L160.58 55.84C160.14 56.57 159.19 57.16 158.46 57.16H158.44C157.71 57.16 157.47 56.57 157.91 55.84L160.34 51.78C160.78 51.05 160.54 50.46 159.81 50.46H153.05C152.32 50.46 151.37 51.05 150.93 51.78L147.1 58.18C146.66 58.91 146.9 59.5 147.63 59.5H166.47C167.2 59.5 168.15 58.91 168.59 58.18L175.43 46.75C175.87 46.02 175.63 45.43 174.9 45.43H165.21C164.7 45.43 164.48 45.08 164.64 44.61C164.67 44.52 164.71 44.43 164.77 44.33L165.05 43.86C165.09 43.79 165.13 43.73 165.18 43.67C165.23 43.61 165.27 43.55 165.31 43.49L168.96 37.4C169.4 36.67 170.35 36.08 171.08 36.08H171.1C171.83 36.08 172.07 36.67 171.63 37.4L169.21 41.44C168.77 42.17 169.01 42.76 169.74 42.76H176.5C177.23 42.76 178.18 42.17 178.62 41.44"
							fill="#231F20" />
						<path
							d="M150.66 47.8L151.06 47.13C151.5 46.4 151.26 45.8 150.53 45.8H143.79C143.06 45.8 142.1 46.4 141.67 47.13L136.44 55.86C136 56.59 135.05 57.19 134.32 57.19C133.59 57.19 133.35 56.59 133.79 55.86L139.81 45.8L141.41 43.13L144.83 37.42C145.27 36.69 146.22 36.09 146.95 36.09C147.68 36.09 147.92 36.68 147.48 37.42L144.85 41.8C144.41 42.53 144.65 43.13 145.38 43.13H152.12C152.85 43.13 153.8 42.54 154.24 41.8L158.28 35.05C158.72 34.32 158.48 33.72 157.75 33.72H138.97C138.24 33.72 137.29 34.31 136.85 35.05L122.99 58.19C122.55 58.92 122.79 59.52 123.52 59.52H132.59C133.51 59.52 133.8 60.26 133.26 61.18L133.19 61.3C133.14 61.39 133.09 61.49 133.03 61.58C132.63 62.23 132.32 62.96 132.11 63.78C131.96 64.33 131.9 64.79 131.91 65.15L132.68 76.14C132.7 76.47 132.8 76.63 132.97 76.63C133.29 76.63 133.7 76.21 134.2 75.36L150.65 47.8H150.66Z"
							fill="#231F20" />
						<path
							d="M59.6104 64.63H60.6604V67.44L61.9904 64.63H63.0404L61.7904 67.08L63.0604 71.3H61.9604L61.0804 68.33L60.6604 69.18V71.3H59.6104V64.63Z"
							fill="#231F20" />
						<path
							d="M66.7998 64.63H69.6598V65.58H67.8498V67.34H69.2898V68.3H67.8498V70.35H69.6598V71.3H66.7998V64.63Z"
							fill="#231F20" />
						<path
							d="M73.5098 64.63H76.3698V65.58H74.5598V67.34H75.9998V68.3H74.5598V70.35H76.3698V71.3H73.5098V64.63Z"
							fill="#231F20" />
						<path
							d="M80.2102 64.63H81.7502C82.2702 64.63 82.6602 64.77 82.9202 65.05C83.1802 65.33 83.3102 65.74 83.3102 66.28V66.94C83.3102 67.48 83.1802 67.89 82.9202 68.17C82.6602 68.45 82.2702 68.59 81.7502 68.59H81.2502V71.31H80.2002V64.63H80.2102ZM81.7502 67.64C81.9202 67.64 82.0502 67.59 82.1402 67.5C82.2302 67.41 82.2702 67.24 82.2702 67.01V66.22C82.2702 65.99 82.2302 65.83 82.1402 65.73C82.0502 65.64 81.9302 65.59 81.7502 65.59H81.2502V67.64H81.7502Z"
							fill="#231F20" />
						<path d="M91.9102 64.63H94.6802V65.58H92.9602V67.44H94.3102V68.39H92.9602V71.3H91.9102V64.63Z"
							fill="#231F20" />
						<path d="M98.4297 64.63H99.4797V70.35H101.21V71.3H98.4297V64.63Z" fill="#231F20" />
						<path
							d="M105.08 68.46L103.81 64.63H104.93L105.64 67.08H105.66L106.38 64.63H107.4L106.13 68.46V71.3H105.08V68.46Z"
							fill="#231F20" />
						<path d="M112.17 64.63H111.12V71.31H112.17V64.63Z" fill="#231F20" />
						<path
							d="M116.19 64.63H117.51L118.53 68.62H118.55V64.63H119.49V71.3H118.41L117.15 66.43H117.13V71.3H116.19V64.63Z"
							fill="#231F20" />
						<path
							d="M123.84 70.96C123.57 70.67 123.44 70.26 123.44 69.72V66.21C123.44 65.67 123.57 65.25 123.84 64.97C124.11 64.68 124.49 64.54 125 64.54C125.51 64.54 125.9 64.68 126.16 64.97C126.43 65.26 126.56 65.67 126.56 66.21V66.78H125.57V66.14C125.57 65.7 125.39 65.48 125.03 65.48C124.67 65.48 124.49 65.7 124.49 66.14V69.79C124.49 70.22 124.67 70.44 125.03 70.44C125.39 70.44 125.57 70.22 125.57 69.79V68.48H125.05V67.53H126.57V69.71C126.57 70.25 126.44 70.67 126.17 70.95C125.9 71.24 125.51 71.38 125.01 71.38C124.51 71.38 124.11 71.23 123.85 70.95"
							fill="#231F20" />
					</g>
					<defs>
						<clipPath id="clip0_816_1318">
							<rect width="182.68" height="76.63" fill="white" />
						</clipPath>
					</defs>
				</svg>
			</div>

			<!-- Location & Mobile in same row with icons and background -->
			<div class="d-flex align-items-center text-end bg-rectangle ">
				<div class="d-flex align-items-center p-2 me-2">
					<i class="bi bi-geo-alt me-2"></i> <!-- Location icon -->
					<p class="mb-0">Location: Your Address</p>
				</div>
				<div class="d-flex align-items-center p-2">
					<i class="bi bi-telephone me-2"></i> <!-- Mobile icon -->
					<p class="mb-0">Mobile: 0123456789</p>
				</div>
			</div>
		</div>
	</div>

	<!-- Logo Rectangle -->
	<div class="row mt-3">
		<div class="col-12 bg-rectangle" style="height: 10px;"></div>
	</div>

	<!-- Invoice Title -->
	<div class="invoice-title">
		Invoice
	</div>

	<!-- Customer Details -->
	<table class="table table-borderless mt-4">
		<tr>
			<td><strong>Name:</strong></td>
			<td>Faisal Hasan</td>
			<td></td>
			<td><strong>Bill No:</strong></td>
			<td>#ws12345678</td>
		</tr>
		<tr>
			<td><strong>Address:</strong></td>
			<td>Barabhita</td>
			<td></td>
			<td><strong>Date:</strong></td>
			<td>21/08/2024</td>
		</tr>
	</table>

	<!-- Item Table -->
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No.</th>
				<th>Description</th>
				<th>Quantity</th>
				<th class="text-right">Rate</th>
				<th class="text-right">Amount</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>1</td>
				<td>Polo Tshirt</td>
				<td>26</td>
				<td class="text-right">925.00/-</td>
				<td class="text-right">24,050.00/-</td>
			</tr>
			<tr>
				<td>2</td>
				<td>Polo Tshirt</td>
				<td>26</td>
				<td class="text-right">25.00/-</td>
				<td class="text-right">24,050.00/-</td>
			</tr>
			<tr>
				<td>3</td>
				<td>Polo Tshirt</td>
				<td>26</td>
				<td class="text-right">25.00/-</td>
				<td class="text-right">24,050.00/-</td>
			</tr>
			<tr class="blank-row">
				<td colspan="5"></td>
			</tr>
			<tr>
				<td colspan="3"></td>
				<td class="text-right"><strong>Total</strong></td>
				<td class="text-right">76,750.00/-</td>
			</tr>
			<tr>
				<td colspan="3"></td>
				<td class="text-right"><strong>Shipping Fee</strong></td>
				<td class="text-right">120.00/-</td>
			</tr>
			<tr>
				<td colspan="3"></td>
				<td class="text-right"><strong>Discount</strong></td>
				<td class="text-right">1,750.00/-</td>
			</tr>
			<tr>
				<td colspan="3"></td>
				<td class="text-right"><strong>Paid</strong></td>
				<td class="text-right">120.00/-</td>
			</tr>
			<tr>
				<td colspan="3" class="taka-in-words">
					<strong>Taka in Words:</strong> Seventy-six Thousand Seven Hundred Fifty Only
				</td>
				<td class="text-right"><strong>Due</strong></td>
				<td class="text-right">76,750.00/-</td>
			</tr>
		</tbody>
	</table>


	<!-- Footer Section -->
	<div class="signature-container">
		<!-- Contact Information as a List -->
		<div class="row">
			<ul class="list-unstyled mb-0">
				<li class="d-flex align-items-center mb-2">
					<i class="bi bi-envelope me-2 fs-6"></i> <!-- Email Icon -->
					<a href="mailto:example@example.com">example@example.com</a>
				</li>
				<li class="d-flex align-items-center mb-2">
					<i class="bi bi-facebook me-2 fs-6"></i> <!-- Facebook Icon -->
					<a href="https://facebook.com/fb_username" target="_blank">username</a>
				</li>
				<li class="d-flex align-items-center">
					<i class="bi bi-globe me-2 fs-6"></i> <!-- Website Icon -->
					<a href="https://www.example.com" target="_blank">www.example.com</a>
				</li>
			</ul>
		</div>


		<!-- Signature Section -->
		<div class="text-center mt-4">
			<img src="{{ asset('images/invoice-signature.png') }}" alt="Signature" width="100" />
			<hr />
			<p><strong>Authorised Signature</strong></p>
		</div>
	</div>



	<!-- Disclaimer -->
	<div class="disclaimer">
		<p>Note: This is an automated invoice. For any discrepancies, please contact support.</p>
	</div>
</div>
@endsection