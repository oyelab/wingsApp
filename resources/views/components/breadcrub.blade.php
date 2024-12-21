<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <ul class="d-flex align-items-center">
                        <li class="home-menu">
                            <a href="{{ route('index') }}">Home</a>
                        </li>
                        @if($section)
                            <li>
                                <a href="{{ route('sections') }}">
                                    Sections
                                </a>
                            </li>
                        @endif
                        @if($collection)
                            <li>
                                <a href="{{ route('collections') }}">
                                    Collections
                                </a>
                            </li>
                        @endif
                        
                        <li>
							<span class="breadcrumb-item breadcrumb-title">
								{{ $pagetitle }}
							</span>
						</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
