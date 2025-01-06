@extends('frontEnd.layouts.app')
@section('content')
<!-- Contact Us -->
<section class="contact-us-area section-padding">
	<div class="container">
		<h2 class="text-center mb-4">Get In Touch</h2>

		<div class="row mt-5">

			<div class="col-md-6">
				<div class="map-area">
					<iframe
						src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.216742985926!2d90.42933582557616!3d23.727108689669773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b838069903af%3A0x9161fc3529f27343!2sSouth%20Mugdapara%2C%20Dhaka!5e1!3m2!1sen!2sbd!4v1731920154430!5m2!1sen!2sbd"
						style="border: 0"
						allowfullscreen=""
						loading="lazy"
						referrerpolicy="no-referrer-when-downgrade"
					></iframe>
				</div>
			</div>

			<div class="col-md-6">
				<div class="row">
					@if(session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
					@endif
					<div class="shadow-sm p-4">
						<form action="{{ route('postInTouch') }}" method="POST">
						@csrf
							<div class="mb-3 shadow-sm">
								<input type="text" name="name" class="form-control bg-transparent border-0" placeholder="Name" required>
							</div>
							<div class="mb-3 shadow-sm">
								<input type="email" name="email" class="form-control bg-transparent border-0" placeholder="Email" required>
							</div>
							<div class="mb-3 shadow-sm">
								<input type="text" name="subject" class="form-control bg-transparent border-0" placeholder="Subject" required>
							</div>
							<div class="mb-3 shadow-sm">
								<textarea class="form-control bg-transparent border-0" name="message" placeholder="Message" rows="5" required></textarea>
							</div>
							<div class="d-grid">
								<button type="submit" class="btn btn-dark btn-lg">Send Message</button>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
@endsection

	