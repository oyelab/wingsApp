<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('build/images/logo-dark-sm.png') }}" alt="" height="26">
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
                <img src="{{ asset('build/images/logo-light-sm.png') }}" alt="" height="26">
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
                <li class="menu-title" data-key="t-applications">Applications</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-store icon nav-icon"></i>
                        <span class="menu-item" data-key="t-manage-product">Manage Product</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('sliders.index') }}" data-key="t-sliders">Sliders</a></li>
                        <li><a href="{{ route('products.index') }}" data-key="t-products">Products</a></li>
                        <li><a href="{{ route('categories.index') }}" data-key="t-categories">Categories</a></li>
                        <li><a href="{{ route('products.index') }}" data-key="t-specifications">Specifications</a></li>
                        <li><a href="{{ route('products.create') }}" data-key="t-add-product">Add Product</a></li>
                    </ul>
                </li>
				
				<li>
                    <a href="{{ route('orders.index') }}">
						<i class="bx bx-box icon nav-icon"></i>
                        <span class="menu-item" data-key="t-order">Manage Orders</span>
                    </a>
                </li>
                <li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="bx bx-star icon nav-icon"></i>
						<span class="menu-item" data-key="t-reviews">Manage Reviews</span>
					</a>
					<ul class="sub-menu" aria-expanded="true">
						<li><a href="{{ route('reviews.index') }}" data-key="t-all-reviews">All Reviews</a></li>
						<li><a href="{{ route('reviews.create') }}" data-key="t-add-review">Add Review</a></li>
					</ul>
				</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="bx bx-image icon nav-icon"></i>
						<span class="menu-item" data-key="t-manage-sliders">Manage Sliders</span>
					</a>
					<ul class="sub-menu" aria-expanded="true">
						<li><a href="{{ route('sliders.index') }}" data-key="t-all-sliders">All Sliders</a></li>
						<li><a href="{{ route('sliders.create') }}" data-key="t-add-slider">Add Slider</a></li>
					</ul>
				</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow">
						<i class="bx bx-gift icon nav-icon"></i>
						<span class="menu-item" data-key="t-manage-vouchers">Manage Vouchers</span>
					</a>
					<ul class="sub-menu" aria-expanded="true">
						<li><a href="{{ route('vouchers.index') }}" data-key="t-all-vouchers">All Vouchers</a></li>
						<li><a href="{{ route('vouchers.create') }}" data-key="t-add-voucher">Add Voucher</a></li>
					</ul>
				</li>

				<li class="menu-title" data-key="t-menu">Dashboard</li>

				<li>
					<a href="javascript: void(0);">
						<i class="bx bx-home-alt icon nav-icon"></i>
						<span class="menu-item" data-key="t-dashboard">Dashboard</span>
						<span class="badge rounded-pill bg-primary">2</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="index" data-key="t-ecommerce">Ecommerce</a></li>
						<li><a href="dashboard-sales" data-key="t-sales">Sales</a></li>
					</ul>
				</li>
				@endif
				@if(Auth::check() && (Auth::user()->role === 1 || Auth::user()->role === 0))
					<li>
						<a href="{{ route('profile') }}">
							<i class="bx bx-user-circle icon nav-icon"></i>
							<span class="menu-item" data-key="t-contacts">My Profile</span>
						</a>
					</li>
				@endif

				@if(Auth::check() && Auth::user()->role === 1)
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-receipt icon nav-icon"></i>
                        <span class="menu-item" data-key="t-invoices">Invoices</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#" data-key="t-invoice-list">Invoice List</a></li>
                        <li><a href="#" data-key="t-invoice-detail">Invoice Detail</a></li>
                    </ul>
                </li>

				
                <li class="menu-title" data-key="t-pages">Utility</li>
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