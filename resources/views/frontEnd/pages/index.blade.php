@extends('frontEnd.layouts.app')
@section('content')
<!-- Useful Pages -->
<div class="useful-pages-area section-padding">
    <div class="container">
        <div class="row">
            <div class="useful-pages-tabs">
                <div class="d-flex justify-content-start useful-pages-tabs-wrap">
					<div class="nav flex-column useful-pages-nav mobile-none" id="v-pills-tab" role="tablist" aria-orientation="vertical">
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
					<div class="mobile-support-pages">
						<div class="dropdown">
							<button
								class="btn btn-secondary dropdown-toggle"
								type="button"
								id="dropdownMenuButton1"
								data-bs-toggle="dropdown"
								aria-expanded="false"
							>
								See All support pages
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
									<path d="M2.4694 9.96943L7.4694 4.96943C7.53908 4.89951 7.62187 4.84404 7.71304 4.80618C7.8042 4.76833 7.90194 4.74884 8.00065 4.74884C8.09936 4.74884 8.1971 4.76833 8.28827 4.80618C8.37943 4.84404 8.46222 4.89951 8.5319 4.96943L13.5319 9.96943C13.6728 10.1103 13.752 10.3014 13.752 10.5007C13.752 10.6999 13.6728 10.891 13.5319 11.0319C13.391 11.1728 13.1999 11.252 13.0007 11.252C12.8014 11.252 12.6103 11.1728 12.4694 11.0319L8.00003 6.56256L3.53065 11.0326C3.38976 11.1735 3.19866 11.2526 2.9994 11.2526C2.80015 11.2526 2.60905 11.1735 2.46815 11.0326C2.32726 10.8917 2.2481 10.7006 2.2481 10.5013C2.2481 10.3021 2.32726 10.111 2.46815 9.97006L2.4694 9.96943Z" fill="currentColor"/>
								</svg>
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
								<div class="nav flex-column mobile-useful-pages-nav" id="v-pills-tab" role="tablist" aria-orientation="vertical">
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
							</div>
						</div>
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

