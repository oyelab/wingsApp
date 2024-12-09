@extends('frontEnd.layouts.app')
@section('css')
<link href="{{ asset('frontEnd/css/test.css')}}" rel="stylesheet" type="text/css" />
<style>
	.modal-middle-details {
		padding: 100px 0px;
		display: flex;
		flex-direction: column;
		justify-content: space-between;
		height: 100%;
	}
	.modal-title {
		color: var(--wings-secondary);
	}
	@media screen and (max-width: 576px) {
		.modal-middle-details {
			padding: 30px 0px 0px 0px;
		}
	}
</style>
@endsection
@section('content')

<section class="order-confirmation">
	<h1 class="confirmation-title">Thank You!</h1>

	<div class="confirmation-content">
		<article class="order-details">
			<section class="message-container">
				<h2 class="section-heading">Your Order Was Placed Successfully.</h2>
				<div class="section-content">
					<p>Note the order ref for tracking order.</p>
					<ul class="info-list">
						<li class="info-item badge-item">Order Ref: {{ $order_details->ref }}</li>
						<li class="info-item">Ordered At: {{ $order_details->tran_date }}</li>
						<li class="info-item">We have sent the order confirmation details to {{ $order_details->email }}
						</li>
					</ul>
				</div>
			</section>

			<section class="delivery-section">
				<h2 class="section-heading">Delivery</h2>
				<div class="section-content">
					<p class="tracking-note">Shipping Address:</p>
					<div class="info-list">
						<ul class="info-list">
							<li class="info-item">{{ $order_details->name }}</li>
							<li class="info-item">{{ $order_details->address }}</li>
							<li class="info-item">{{ $order_details->email }}</li>
							<li class="info-item">{{ $order_details->phone }}</li>
						</ul>
					</div>
				</div>
			</section>
		</article>

		<aside class="summary-section">
			<h2 class="section-heading">Summary</h2>
			<p>Order information:</p>

			@foreach ($order_items as $item)
				<article class="product-items">
					<img src="{{ $item['imagePath'] }}" alt="{{ $item['title'] }}" class="product-image" />

					<div class="product-details">
						<h4>{{ $item['title'] }}</h4>
						<p class="info-item">
							Regular Price: Tk. {{ $item['price'] }}
						</p>

						@if ($item['sale'] < $item['price'])
							<p class="info-item">
								Offer Price: Tk. {{ $item['sale'] }}
							</p>
						@endif
						<p class="info-item">Categories: {{ $item['categories'] }}</p>
						<p class="info-item">Size: {{ $item['size'] }}</p>
						<p class="info-item">Quantity: {{ $item['quantity'] }}</p>
					</div>
				</article>
			@endforeach

			<div class="cost-summary">
				<div class="subtotal-labels">
					<p>Subtotal</p>
					<p>Product Discount</p>
					<p>Voucher Discount</p>
					<p>Delivery Charge</p>
				</div>
				<div class="subtotal-values">
					<p>Tk. {{ $order_details->subtotal }}</p>
					<p>{{ $order_details->discount ? '৳' . $order_details->discount : 'N/A' }}</p>
					<p>{{ $order_details->voucher ? '৳' . $order_details->voucher : 'N/A' }}</p>
					<p>Tk. {{ $order_details->shipping_charge }}</p>
				</div>
			</div>

			<hr class="divider" />

			<div class="total-summary">
				<div class="cost-labels">
					<p>Order Total</p>
					<p>Paid</p>
					@if ($order_details->unpaid_amount > 0)
						<p>Unpaid</p>
					@endif
				</div>
				<div class="cost-values">
					<p>Tk. {{ $order_details->order_total }}</p>
					<p>Tk. {{ $order_details->paid }}</p>
					@if ($order_details->unpaid_amount > 0)
						<p>Tk. {{ $order_details->unpaid_amount }}</p>
					@endif
				</div>
			</div>
		</aside>
	</div>

	<a href="{{ route('order.invoice', $order_details) }}">
		<button 
			class="print-button" 
		>
			<span class="print-content">
				<span>Download Invoice</span>
			</span>
		</button>
	</a>
</section>
@if ($showModal)
<div
    class="modal fade"
    id="staticBackdrop"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered print-invoice-modal">
        <div class="modal-content">
            <div class="modal-content-wrap d-flex justify-content-between align-items-center">
                <!-- Left section with features list -->
                <div class="h-100">
                    <div class="modal-left-details">
                        <div class="logo-wrap d-flex justify-content-center mb-4 position-relative">
							<a href="{{ route('index') }}">
								<img
									src="{{ $siteSettings->getImagePath('logo_v2') }}"
									draggable="false"
									alt="{{ $siteSettings->title }} Logo"
									height="75"
								/>
							</a>
							<div class="mobile-close-icon">
									<div class="modal-close-icon" data-bs-dismiss="modal" aria-label="Close">
								<i class="bi bi-x text-light fs-3"></i>
							</div>
							</div>
                        </div>
                    
                        <h3>Make shopping with Wings Sportswear easier and more convenient with these features:</h3>
                        <hr class="my-2">

                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <ul>
                                    <li><a href="#"><i class="bi bi-grid"></i> Manage Orders</a></li>
                                    <li><a href="#"><i class="bi bi-fast-forward"></i> Faster Checkout</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-12">
                                <ul>
                                    <li><a href="#"><i class="bi bi-star"></i> Add Review</a></li>
                                    <li><a href="#"><i class="bi bi-arrow-repeat"></i> Refund Request</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Middle section with logo, login, and cancel link -->
                <div class="modal-middle-details w-md-75">
                    <h3 class="modal-title" id="staticBackdropLabel">Hi, {{ $order_details->name }}</h3>

                    <div class="login-wrap">
                        <h3 class="mt-5">You're Creating New Account for: {{ $order_details->email }}</h3>
						@if ($errors->any())
							<div class="alert" style="color: var(--wings-alternative); margin-bottom: 10px; padding: 0; border: none;">
								<ul style="list-style-type: none; margin: 0; padding: 0;">
									@foreach ($errors->all() as $error)
										<li style="background-color: transparent;">
											{{ $error }}
										</li>
									@endforeach
								</ul>
							</div>
						@endif
                        <form method="POST" action="{{ route('register') }}" class="input-wraps" id="registerForm">
                            @csrf
                            <input type="hidden" name="name" value="{{ $order_details->name }}">
                            <input type="hidden" name="email" value="{{ $order_details->email }}">
							<input type="hidden" name="order_id" value="{{ $order_details->id }}">
							<input type="hidden" name="redirect_to" value="{{ url()->previous() }}">


                            <div class="input-wrap">
                                <input type="password" name="password" id="inputPassword" placeholder="Enter new password" />
                                <button type="submit">
                                    <i class="bi bi-arrow-right text-light fs-3"></i>
                                </button>
                            </div>
                            <label class="d-flex align-items-center gap-1" style="cursor: pointer; font-size: 1rem; color: #fff; white-space: nowrap;">
                                <input type="checkbox" id="iAgree" name="terms" class="me-2"/>
                                I agree to Wings 
                                <a href="{{ route('help.index') }}#terms-conditions" target="_blank" style="text-decoration: none; color: inherit;">Terms & Policy.</a>
                            </label>
                        </form>

                    </div>
                    
                    <a class="cancel-button" href="#">
                        Cancel & go to order page
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                
                <!-- Close icon -->
                <div class="h-100 close-icon-mobile-none">
                    <div class="modal-close-icon" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x text-light fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')

@if ($errors->any() || $showModal)
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
            modal.show();
        });
    </script>
@endif

<script>
	$(document).ready(function () {
		// Check localStorage for modal display status
		if (!localStorage.getItem('modalClosed')) {
			// Only show modal if $showModal is true
			@if ($showModal)
				$('#welcomeModal').modal('show');
			@endif
		}

		// Close button click event
		$('#closeModalButton, .close').on('click', function () {
			$('#welcomeModal').modal('hide'); // Hide the modal
			localStorage.setItem('modalClosed', 'true'); // Set flag in localStorage
		});
	});
</script>
@endsection