@extends('frontEnd.layouts.app')
@section('content')
<!-- Useful Pages -->
<div class="useful-pages-area section-padding">
    <div class="container">
        <div class="row">
            <div class="useful-pages-tabs">
                <div class="d-flex justify-content-start">
					<div class="nav flex-column me-5 useful-pages-nav border-end border-3 pe-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						@foreach ($pages as $key => $page)
							<button
								class="nav-link {{ $key == 0 ? 'active' : '' }}"
								id="{{ $page->slug }}-tab"
								data-bs-toggle="pill"
								data-bs-target="#{{ $page->slug }}"
								type="button"
								role="tab"
								aria-controls="{{ $page->slug }}"
								aria-selected="{{ $key == 0 ? 'true' : 'false' }}"
							>
								{{ $page->title }}
							</button>
						@endforeach
					</div>

                    <div class="tab-content" id="v-pills-tabContent">
						@foreach($pages as $key => $page)
							<div
								class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}"
								id="{{ $page->slug }}"
								role="tabpanel"
								aria-labelledby="{{ $page->slug }}-tab"
							>
								<div class="useful-pages-content">
									<h2>{{ $page->title }}</h2>
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

