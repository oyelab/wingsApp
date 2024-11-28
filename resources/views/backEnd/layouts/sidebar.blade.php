<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('build/images/icon-dark.svg') }}" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('build/images/logo-dark.svg') }}" alt="" height="28">
            </span>
        </a>

        <a href="{{ route('dashboard') }}" class="logo logo-light">
            <span class="logo-lg">
                <img src="{{ asset('build/images/logo-light.svg') }}" alt="" height="30">
            </span>
            <span class="logo-sm">
                <img src="{{ asset('build/images/icon-light.svg') }}" alt="" height="26">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
        <i class="bx bx-menu align-middle"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
				@if(Auth::check() && Auth::user()->role === 1)
				<li class="menu-title" data-key="t-dashboard">Dashboard</li>

				<li>
					<a href="{{ route('dashboard') }}">
						<i class="bx bx-home-alt icon nav-icon"></i>
						<span class="menu-item" data-key="t-overview">Overview</span>
					</a>
					<!-- <ul class="sub-menu" aria-expanded="true">
						<li><a href="#" data-key="t-ecommerce">Ecommerce</a></li>
						<li><a href="#" data-key="t-sales">Sales</a></li>
					</ul> -->
				</li>
                <li class="menu-title" data-key="t-applications">Applications</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-store icon nav-icon"></i>
                        <span class="menu-item" data-key="t-manage-collections">Collections</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
						<li><a href="{{ route('products.create') }}" data-key="t-add-product-new-product-item">Add New Product/Item</a></li>
                        <li><a href="{{ route('products.index') }}" data-key="t-products">Products/Items</a></li>
                        <li><a href="{{ route('categories.index') }}" data-key="t-categories">Categories</a></li>
                        <li><a href="{{ route('specifications.index') }}" data-key="t-specifications">Specifications</a></li>
                    </ul>
                </li>

				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="bx bx-briefcase icon nav-icon"></i>
						<span class="menu-item" data-key="t-portfolio">Showcase</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="{{ route('showcases.create') }}" data-key="t-add-showcase">Add Showcase</a></li>
						<li><a href="{{ route('showcases.index') }}" data-key="t-all-showcase">All Showcase</a></li>
					</ul>
				</li>


				<li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-box icon nav-icon"></i>
                        <span class="menu-item" data-key="t-orders">Orders</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('orders.index') }}" data-key="t-orders">Orders</a></li>
                        <li><a href="#" data-key="t-invoice-lists">Invoice Lists</a></li>
                    </ul>
                </li>
				<li>
					<a href="{{ route('reviews.index') }}">
						<i class="bx bx-star icon nav-icon"></i>
						<span class="menu-item" data-key="t-reviews">Reviews</span>
					</a>
				</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="bx bx-image icon nav-icon"></i>
						<span class="menu-item" data-key="t-sliders">Sliders</span>
					</a>
					<ul class="sub-menu" aria-expanded="true">
						<li><a href="{{ route('sliders.index') }}" data-key="t-all-sliders">All Sliders</a></li>
						<li><a href="{{ route('sliders.create') }}" data-key="t-add-slider">Add Slider</a></li>
					</ul>
				</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="bx bx-image icon nav-icon"></i>
						<span class="menu-item" data-key="t-sections">Sections</span>
					</a>
					<ul class="sub-menu" aria-expanded="true">
						<li><a href="{{ route('sections.index') }}" data-key="t-all-sections">All Sections</a></li>
						<li><a href="{{ route('sections.create') }}" data-key="t-add-section">Add Section</a></li>
					</ul>
				</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="bx bx-gift icon nav-icon"></i>
						<span class="menu-item" data-key="t-manage-vouchers">Vouchers</span>
					</a>
					<ul class="sub-menu" aria-expanded="true">
						<li><a href="{{ route('vouchers.index') }}" data-key="t-all-vouchers">All Vouchers</a></li>
						<li><a href="{{ route('vouchers.create') }}" data-key="t-add-voucher">Add Voucher</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="bx bx-image icon nav-icon"></i>
						<span class="menu-item" data-key="t-manage-assets">Assets</span>
					</a>
					<ul class="sub-menu" aria-expanded="true">
						<li><a href="{{ route('assets.index') }}" data-key="t-all-assets">All Assets</a></li>
						<li><a href="{{ route('assets.create') }}" data-key="t-add-asset">Add Asset</a></li>
					</ul>
				</li>

				@endif
				@if(Auth::check() && (Auth::user()->role === 1 || Auth::user()->role === 0))
				<li class="menu-title" data-key="t-user-profile">User Profile</li>
					<li>
						<a href="{{ route('profile') }}">
							<i class="bx bx-user-circle icon nav-icon"></i>
							<span class="menu-item" data-key="t-my-profile">My Profile</span>
						</a>
					</li>
					<li>
						<a href="{{ route('user.orders') }}">
							<i class="bx bx-box icon nav-icon"></i>
							<span class="menu-item" data-key="t-my-orders">My Orders</span>
						</a>
					</li>

				@endif

				@if(Auth::check() && Auth::user()->role === 1)
                <li class="menu-title" data-key="t-pages">Utility</li>
				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="bx bx-file icon nav-icon"></i>
						<span class="menu-item" data-key="t-manage-pages">Pages</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="{{ route('pages.index') }}" data-key="t-all-pages">All Pages</a></li>
						<li><a href="{{ route('pages.create') }}" data-key="t-create-page">Create New</a></li>
					</ul>
				</li>

				<li>
					<a href="{{ route('settings.index') }}">
						<i class="bx bx-cog icon nav-icon"></i>
						<span class="menu-item" data-key="t-site-settings">Site Settings</span>
					</a>
				</li>
				
				@endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->