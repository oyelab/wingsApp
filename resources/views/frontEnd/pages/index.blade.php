@extends('frontEnd.layouts.app')
@section('content')
<!-- Useful Pages -->
<div class="useful-pages-area section-padding">
    <div class="container">
        <div class="row">
			<div class="useful-pages-tabs">
				<div class="d-flex justify-content-start useful-pages-tabs-wrap">
					<!-- Desktop Tabs -->
					<div class="nav flex-column useful-pages-nav mobile-none" id="desktop-v-pills-tab" role="tablist" aria-orientation="vertical">
						@foreach ($pages as $key => $page)
							<button
								class="nav-link {{ $key == 0 ? 'active' : '' }}"
								id="{{ $page->slug }}-tab"
								data-bs-toggle="pill"
								data-bs-target="#{{ $page->slug }}"
								type="button"
								role="tab"
								aria-controls="{{ $page->slug }}"
								aria-selected="{{ $key == 0 ? 'true' : 'false' }}">
								{{ $page->title }}
							</button>
						@endforeach
					</div>

					<!-- Mobile Tabs -->
					<div class="mobile-support-pages">
						<div class="dropdown">
							<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
								See All Support Pages
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
								<div class="nav flex-column mobile-useful-pages-nav" id="mobile-v-pills-tab" role="tablist" aria-orientation="vertical">
									@foreach ($pages as $key => $page)
										<button
											class="nav-link {{ $key == 0 ? 'active' : '' }}"
											id="mobile-{{ $page->slug }}-tab"
											data-bs-toggle="pill"
											data-bs-target="#{{ $page->slug }}"
											type="button"
											role="tab"
											aria-controls="{{ $page->slug }}"
											aria-selected="{{ $key == 0 ? 'true' : 'false' }}">
											{{ $page->title }}
										</button>
									@endforeach
								</div>
							</div>
						</div>
					</div>

					<!-- Tab Content -->
					<div class="tab-content" id="v-pills-tabContent">
						@foreach($pages as $key => $page)
							<div
								class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}"
								id="{{ $page->slug }}"
								role="tabpanel"
								aria-labelledby="{{ $page->slug }}-tab">
								<div class="useful-pages-content">
									<p>{!! $page->content !!}</p>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>

        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
	document.querySelectorAll('.useful-pages-nav .nav-link').forEach(button => {
		button.addEventListener('click', function () {
			const targetId = this.getAttribute('data-bs-target').substring(1); // Remove the `#` prefix
			history.pushState(null, null, `#${targetId}`); // Update the URL hash
		});
	});

	// Ensure the correct tab is active based on the current URL hash on page load
	document.addEventListener('DOMContentLoaded', function () {
		const currentHash = window.location.hash.substring(1); // Remove the `#` prefix
		if (currentHash) {
			const targetButton = document.querySelector(`.nav-link[data-bs-target="#${currentHash}"]`);
			if (targetButton) {
				targetButton.click(); // Simulate a click to activate the tab
			}
		}
	});
	
</script>
@endsection

