
<!-- breadcrumb section -->
<div class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="breadcrumb-content">
					<ul class="d-flex align-items-center">
						<li class="home-menu">
							<a href="{{ route('index') }}">Home</a>
						</li>
						<li>
							<a href="{{ route('collections') }}">Collections</a>
						</li>
						<li>
							{{ $pagetitle }}
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end page title -->