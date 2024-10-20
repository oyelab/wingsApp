@extends('frontEnd.layouts.app')
@section('css')
    
@endsection
@section('content')
	<!-- breadcrumb section -->
	<div class="breadcrumb-section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="breadcrumb-content">
						<ul class="d-flex align-items-center">
							<li class="home-menu">
								<a href="/">Home</a>
							</li>
							<li>
								<a href="/">New Arrivals</a>
							</li>
							<li>Concept Jersey</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Category product -->
	<div class="category-product-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-4">
					<div class="filters-area d-flex flex-column">
						<div
							class="top-heading d-flex align-items-center justify-content-between"
						>
							<h2>Filters</h2>
							<svg
								xmlns="http://www.w3.org/2000/svg"
								width="24"
								height="25"
								viewBox="0 0 24 25"
								fill="none"
							>
								<path
									d="M13.125 12.125V20.75C13.125 21.0484 13.0065 21.3345 12.7955 21.5455C12.5845 21.7565 12.2984 21.875 12 21.875C11.7016 21.875 11.4155 21.7565 11.2045 21.5455C10.9935 21.3345 10.875 21.0484 10.875 20.75V12.125C10.875 11.8266 10.9935 11.5405 11.2045 11.3295C11.4155 11.1185 11.7016 11 12 11C12.2984 11 12.5845 11.1185 12.7955 11.3295C13.0065 11.5405 13.125 11.8266 13.125 12.125ZM18.75 18.5C18.4516 18.5 18.1655 18.6185 17.9545 18.8295C17.7435 19.0405 17.625 19.3266 17.625 19.625V20.75C17.625 21.0484 17.7435 21.3345 17.9545 21.5455C18.1655 21.7565 18.4516 21.875 18.75 21.875C19.0484 21.875 19.3345 21.7565 19.5455 21.5455C19.7565 21.3345 19.875 21.0484 19.875 20.75V19.625C19.875 19.3266 19.7565 19.0405 19.5455 18.8295C19.3345 18.6185 19.0484 18.5 18.75 18.5ZM21 14.75H19.875V4.25C19.875 3.95163 19.7565 3.66548 19.5455 3.4545C19.3345 3.24353 19.0484 3.125 18.75 3.125C18.4516 3.125 18.1655 3.24353 17.9545 3.4545C17.7435 3.66548 17.625 3.95163 17.625 4.25V14.75H16.5C16.2016 14.75 15.9155 14.8685 15.7045 15.0795C15.4935 15.2905 15.375 15.5766 15.375 15.875C15.375 16.1734 15.4935 16.4595 15.7045 16.6705C15.9155 16.8815 16.2016 17 16.5 17H21C21.2984 17 21.5845 16.8815 21.7955 16.6705C22.0065 16.4595 22.125 16.1734 22.125 15.875C22.125 15.5766 22.0065 15.2905 21.7955 15.0795C21.5845 14.8685 21.2984 14.75 21 14.75ZM5.25 15.5C4.95163 15.5 4.66548 15.6185 4.4545 15.8295C4.24353 16.0405 4.125 16.3266 4.125 16.625V20.75C4.125 21.0484 4.24353 21.3345 4.4545 21.5455C4.66548 21.7565 4.95163 21.875 5.25 21.875C5.54837 21.875 5.83452 21.7565 6.0455 21.5455C6.25647 21.3345 6.375 21.0484 6.375 20.75V16.625C6.375 16.3266 6.25647 16.0405 6.0455 15.8295C5.83452 15.6185 5.54837 15.5 5.25 15.5ZM7.5 11.75H6.375V4.25C6.375 3.95163 6.25647 3.66548 6.0455 3.4545C5.83452 3.24353 5.54837 3.125 5.25 3.125C4.95163 3.125 4.66548 3.24353 4.4545 3.4545C4.24353 3.66548 4.125 3.95163 4.125 4.25V11.75H3C2.70163 11.75 2.41548 11.8685 2.2045 12.0795C1.99353 12.2905 1.875 12.5766 1.875 12.875C1.875 13.1734 1.99353 13.4595 2.2045 13.6705C2.41548 13.8815 2.70163 14 3 14H7.5C7.79837 14 8.08452 13.8815 8.2955 13.6705C8.50647 13.4595 8.625 13.1734 8.625 12.875C8.625 12.5766 8.50647 12.2905 8.2955 12.0795C8.08452 11.8685 7.79837 11.75 7.5 11.75ZM14.25 7.25H13.125V4.25C13.125 3.95163 13.0065 3.66548 12.7955 3.4545C12.5845 3.24353 12.2984 3.125 12 3.125C11.7016 3.125 11.4155 3.24353 11.2045 3.4545C10.9935 3.66548 10.875 3.95163 10.875 4.25V7.25H9.75C9.45163 7.25 9.16548 7.36853 8.9545 7.5795C8.74353 7.79048 8.625 8.07663 8.625 8.375C8.625 8.67337 8.74353 8.95952 8.9545 9.1705C9.16548 9.38147 9.45163 9.5 9.75 9.5H14.25C14.5484 9.5 14.8345 9.38147 15.0455 9.1705C15.2565 8.95952 15.375 8.67337 15.375 8.375C15.375 8.07663 15.2565 7.79048 15.0455 7.5795C14.8345 7.36853 14.5484 7.25 14.25 7.25Z"
									fill="#858585"
								/>
							</svg>
						</div>
						<div class="border-line"></div>
						<ul
							class="filter-category-menu d-flex flex-column"
							id="categoryMenu"
						>
							<li>
								<a href="#" class="link"
									>Jersey
									<svg
										xmlns="http://www.w3.org/2000/svg"
										width="16"
										height="17"
										viewBox="0 0 16 17"
										fill="none"
									>
										<path
											d="M6.53025 2.9694L11.5302 7.9694C11.6002 8.03908 11.6556 8.12187 11.6935 8.21304C11.7314 8.3042 11.7508 8.40194 11.7508 8.50065C11.7508 8.59936 11.7314 8.6971 11.6935 8.78827C11.6556 8.87943 11.6002 8.96222 11.5302 9.0319L6.53025 14.0319C6.38935 14.1728 6.19825 14.252 5.999 14.252C5.79974 14.252 5.60864 14.1728 5.46775 14.0319C5.32685 13.891 5.2477 13.6999 5.2477 13.5007C5.2477 13.3014 5.32685 13.1103 5.46775 12.9694L9.93712 8.50003L5.46712 4.03065C5.32623 3.88976 5.24707 3.69866 5.24707 3.4994C5.24707 3.30015 5.32623 3.10905 5.46712 2.96815C5.60802 2.82726 5.79911 2.7481 5.99837 2.7481C6.19763 2.7481 6.38873 2.82726 6.52962 2.96815L6.53025 2.9694Z"
											fill="currentColor"
										/>
									</svg>
								</a>
								<div class="sub-category">
									<ul>
										<li>
											<a href="#">Concept Jersey</a>
										</li>
										<li>
											<a href="#">Football Jersey</a>
										</li>
										<li>
											<a href="#"
												>Basketball Jersey</a
											>
										</li>
										<li>
											<a href="#">Cricket Jersey</a>
										</li>
									</ul>
								</div>
							</li>
							<li>
								<a href="#" class="link"
									>Jersey
									<svg
										xmlns="http://www.w3.org/2000/svg"
										width="16"
										height="17"
										viewBox="0 0 16 17"
										fill="none"
									>
										<path
											d="M6.53025 2.9694L11.5302 7.9694C11.6002 8.03908 11.6556 8.12187 11.6935 8.21304C11.7314 8.3042 11.7508 8.40194 11.7508 8.50065C11.7508 8.59936 11.7314 8.6971 11.6935 8.78827C11.6556 8.87943 11.6002 8.96222 11.5302 9.0319L6.53025 14.0319C6.38935 14.1728 6.19825 14.252 5.999 14.252C5.79974 14.252 5.60864 14.1728 5.46775 14.0319C5.32685 13.891 5.2477 13.6999 5.2477 13.5007C5.2477 13.3014 5.32685 13.1103 5.46775 12.9694L9.93712 8.50003L5.46712 4.03065C5.32623 3.88976 5.24707 3.69866 5.24707 3.4994C5.24707 3.30015 5.32623 3.10905 5.46712 2.96815C5.60802 2.82726 5.79911 2.7481 5.99837 2.7481C6.19763 2.7481 6.38873 2.82726 6.52962 2.96815L6.53025 2.9694Z"
											fill="currentColor"
										/>
									</svg>
								</a>
								<div class="sub-category">
									<ul>
										<li>
											<a href="#">Concept Jersey</a>
										</li>
										<li>
											<a href="#">Football Jersey</a>
										</li>
										<li>
											<a href="#"
												>Basketball Jersey</a
											>
										</li>
										<li>
											<a href="#">Cricket Jersey</a>
										</li>
									</ul>
								</div>
							</li>
							<li>
								<a href="#" class="link"
									>Jersey
									<svg
										xmlns="http://www.w3.org/2000/svg"
										width="16"
										height="17"
										viewBox="0 0 16 17"
										fill="none"
									>
										<path
											d="M6.53025 2.9694L11.5302 7.9694C11.6002 8.03908 11.6556 8.12187 11.6935 8.21304C11.7314 8.3042 11.7508 8.40194 11.7508 8.50065C11.7508 8.59936 11.7314 8.6971 11.6935 8.78827C11.6556 8.87943 11.6002 8.96222 11.5302 9.0319L6.53025 14.0319C6.38935 14.1728 6.19825 14.252 5.999 14.252C5.79974 14.252 5.60864 14.1728 5.46775 14.0319C5.32685 13.891 5.2477 13.6999 5.2477 13.5007C5.2477 13.3014 5.32685 13.1103 5.46775 12.9694L9.93712 8.50003L5.46712 4.03065C5.32623 3.88976 5.24707 3.69866 5.24707 3.4994C5.24707 3.30015 5.32623 3.10905 5.46712 2.96815C5.60802 2.82726 5.79911 2.7481 5.99837 2.7481C6.19763 2.7481 6.38873 2.82726 6.52962 2.96815L6.53025 2.9694Z"
											fill="currentColor"
										/>
									</svg>
								</a>
								<div class="sub-category">
									<ul>
										<li>
											<a href="#">Concept Jersey</a>
										</li>
										<li>
											<a href="#">Football Jersey</a>
										</li>
										<li>
											<a href="#"
												>Basketball Jersey</a
											>
										</li>
										<li>
											<a href="#">Cricket Jersey</a>
										</li>
									</ul>
								</div>
							</li>
							<li>
								<a href="#" class="link"
									>Jersey
									<svg
										xmlns="http://www.w3.org/2000/svg"
										width="16"
										height="17"
										viewBox="0 0 16 17"
										fill="none"
									>
										<path
											d="M6.53025 2.9694L11.5302 7.9694C11.6002 8.03908 11.6556 8.12187 11.6935 8.21304C11.7314 8.3042 11.7508 8.40194 11.7508 8.50065C11.7508 8.59936 11.7314 8.6971 11.6935 8.78827C11.6556 8.87943 11.6002 8.96222 11.5302 9.0319L6.53025 14.0319C6.38935 14.1728 6.19825 14.252 5.999 14.252C5.79974 14.252 5.60864 14.1728 5.46775 14.0319C5.32685 13.891 5.2477 13.6999 5.2477 13.5007C5.2477 13.3014 5.32685 13.1103 5.46775 12.9694L9.93712 8.50003L5.46712 4.03065C5.32623 3.88976 5.24707 3.69866 5.24707 3.4994C5.24707 3.30015 5.32623 3.10905 5.46712 2.96815C5.60802 2.82726 5.79911 2.7481 5.99837 2.7481C6.19763 2.7481 6.38873 2.82726 6.52962 2.96815L6.53025 2.9694Z"
											fill="currentColor"
										/>
									</svg>
								</a>
								<div class="sub-category">
									<ul>
										<li>
											<a href="#">Concept Jersey</a>
										</li>
										<li>
											<a href="#">Football Jersey</a>
										</li>
										<li>
											<a href="#"
												>Basketball Jersey</a
											>
										</li>
										<li>
											<a href="#">Cricket Jersey</a>
										</li>
									</ul>
								</div>
							</li>
							<li>
								<a href="#" class="link"
									>Jersey
									<svg
										xmlns="http://www.w3.org/2000/svg"
										width="16"
										height="17"
										viewBox="0 0 16 17"
										fill="none"
									>
										<path
											d="M6.53025 2.9694L11.5302 7.9694C11.6002 8.03908 11.6556 8.12187 11.6935 8.21304C11.7314 8.3042 11.7508 8.40194 11.7508 8.50065C11.7508 8.59936 11.7314 8.6971 11.6935 8.78827C11.6556 8.87943 11.6002 8.96222 11.5302 9.0319L6.53025 14.0319C6.38935 14.1728 6.19825 14.252 5.999 14.252C5.79974 14.252 5.60864 14.1728 5.46775 14.0319C5.32685 13.891 5.2477 13.6999 5.2477 13.5007C5.2477 13.3014 5.32685 13.1103 5.46775 12.9694L9.93712 8.50003L5.46712 4.03065C5.32623 3.88976 5.24707 3.69866 5.24707 3.4994C5.24707 3.30015 5.32623 3.10905 5.46712 2.96815C5.60802 2.82726 5.79911 2.7481 5.99837 2.7481C6.19763 2.7481 6.38873 2.82726 6.52962 2.96815L6.53025 2.9694Z"
											fill="currentColor"
										/>
									</svg>
								</a>
								<div class="sub-category">
									<ul>
										<li>
											<a href="#">Concept Jersey</a>
										</li>
										<li>
											<a href="#">Football Jersey</a>
										</li>
										<li>
											<a href="#"
												>Basketball Jersey</a
											>
										</li>
										<li>
											<a href="#">Cricket Jersey</a>
										</li>
									</ul>
								</div>
							</li>
							<li>
								<a href="#" class="link"
									>Jersey
									<svg
										xmlns="http://www.w3.org/2000/svg"
										width="16"
										height="17"
										viewBox="0 0 16 17"
										fill="none"
									>
										<path
											d="M6.53025 2.9694L11.5302 7.9694C11.6002 8.03908 11.6556 8.12187 11.6935 8.21304C11.7314 8.3042 11.7508 8.40194 11.7508 8.50065C11.7508 8.59936 11.7314 8.6971 11.6935 8.78827C11.6556 8.87943 11.6002 8.96222 11.5302 9.0319L6.53025 14.0319C6.38935 14.1728 6.19825 14.252 5.999 14.252C5.79974 14.252 5.60864 14.1728 5.46775 14.0319C5.32685 13.891 5.2477 13.6999 5.2477 13.5007C5.2477 13.3014 5.32685 13.1103 5.46775 12.9694L9.93712 8.50003L5.46712 4.03065C5.32623 3.88976 5.24707 3.69866 5.24707 3.4994C5.24707 3.30015 5.32623 3.10905 5.46712 2.96815C5.60802 2.82726 5.79911 2.7481 5.99837 2.7481C6.19763 2.7481 6.38873 2.82726 6.52962 2.96815L6.53025 2.9694Z"
											fill="currentColor"
										/>
									</svg>
								</a>
								<div class="sub-category">
									<ul>
										<li>
											<a href="#">Concept Jersey</a>
										</li>
										<li>
											<a href="#">Football Jersey</a>
										</li>
										<li>
											<a href="#"
												>Basketball Jersey</a
											>
										</li>
										<li>
											<a href="#">Cricket Jersey</a>
										</li>
									</ul>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-9 col-md-8">
					<div
						class="top-bar d-flex align-items-center justify-content-between"
					>
						<h3>Concept Jersey (200)</h3>
						<div class="sort-by">
							<span>Sort by:</span>
							<div class="custom-select-wrapper">
								<select name="sort" id="sort">
									<option value="most-popular">
										Most Popular
									</option>
									<option value="oldest">Oldest</option>
									<option value="price-low">
										Price: Low to High
									</option>
									<option value="price-high">
										Price: High to Low
									</option>
								</select>
								<span class="custom-arrow">
									<svg
										xmlns="http://www.w3.org/2000/svg"
										width="16"
										height="16"
										viewBox="0 0 16 16"
										fill="none"
									>
										<path
											d="M13.5306 6.53063L8.5306 11.5306C8.46092 11.6005 8.37813 11.656 8.28696 11.6939C8.1958 11.7317 8.09806 11.7512 7.99935 11.7512C7.90064 11.7512 7.8029 11.7317 7.71173 11.6939C7.62057 11.656 7.53778 11.6005 7.4681 11.5306L2.4681 6.53063C2.3272 6.38973 2.24805 6.19864 2.24805 5.99938C2.24805 5.80012 2.3272 5.60902 2.4681 5.46813C2.60899 5.32723 2.80009 5.24808 2.99935 5.24808C3.19861 5.24808 3.3897 5.32723 3.5306 5.46813L7.99997 9.9375L12.4693 5.4675C12.6102 5.32661 12.8013 5.24745 13.0006 5.24745C13.1999 5.24745 13.391 5.32661 13.5318 5.4675C13.6727 5.6084 13.7519 5.7995 13.7519 5.99875C13.7519 6.19801 13.6727 6.38911 13.5318 6.53L13.5306 6.53063Z"
											fill="currentColor"
										/>
									</svg>
								</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<a href="#" class="category-product">
								<div class="cat-product-img">
									<img
										src="{{ asset('frontEnd/images/category-p.jpg') }}"
										draggable="false"
										alt="product"
									/>
								</div>
								<div
									class="cat-p-content d-flex flex-column"
								>
									<h4>Gradient Graphic T-shirt</h4>
									<div
										class="rating-area d-flex align-items-center"
									>
										<ul
											class="d-flex align-items-center"
										>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="19"
													height="17"
													viewBox="0 0 19 17"
													fill="none"
												>
													<path
														d="M9.24494 0.255066L11.8641 5.89498L18.0374 6.64316L13.4829 10.877L14.679 16.9793L9.24494 13.9561L3.8109 16.9793L5.00697 10.877L0.452479 6.64316L6.62573 5.89498L9.24494 0.255066Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="19"
													height="17"
													viewBox="0 0 19 17"
													fill="none"
												>
													<path
														d="M9.24494 0.255066L11.8641 5.89498L18.0374 6.64316L13.4829 10.877L14.679 16.9793L9.24494 13.9561L3.8109 16.9793L5.00697 10.877L0.452479 6.64316L6.62573 5.89498L9.24494 0.255066Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="19"
													height="17"
													viewBox="0 0 19 17"
													fill="none"
												>
													<path
														d="M9.24494 0.255066L11.8641 5.89498L18.0374 6.64316L13.4829 10.877L14.679 16.9793L9.24494 13.9561L3.8109 16.9793L5.00697 10.877L0.452479 6.64316L6.62573 5.89498L9.24494 0.255066Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="10"
													height="17"
													viewBox="0 0 10 17"
													fill="none"
												>
													<path
														d="M3.76369 16.9793L9.19773 13.9561V0.255066L6.57853 5.89498L0.405273 6.64316L4.95977 10.877L3.76369 16.9793Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
										</ul>
										<h5>3.5/5</h5>
									</div>
									<div
										class="pricing-area d-flex align-items-center"
									>
										<div class="current-price">
											৳599
										</div>
										<div class="discount-price">
											৳699
										</div>
										<div class="discount-percent">
											-30%
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-4">
							<a href="#" class="category-product">
								<div class="cat-product-img">
									<img
										src="{{ asset('frontEnd/images/category-p.jpg') }}"
										draggable="false"
										alt="product"
									/>
								</div>
								<div
									class="cat-p-content d-flex flex-column"
								>
									<h4>Gradient Graphic T-shirt</h4>
									<div
										class="rating-area d-flex align-items-center"
									>
										<ul
											class="d-flex align-items-center"
										>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="19"
													height="17"
													viewBox="0 0 19 17"
													fill="none"
												>
													<path
														d="M9.24494 0.255066L11.8641 5.89498L18.0374 6.64316L13.4829 10.877L14.679 16.9793L9.24494 13.9561L3.8109 16.9793L5.00697 10.877L0.452479 6.64316L6.62573 5.89498L9.24494 0.255066Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="19"
													height="17"
													viewBox="0 0 19 17"
													fill="none"
												>
													<path
														d="M9.24494 0.255066L11.8641 5.89498L18.0374 6.64316L13.4829 10.877L14.679 16.9793L9.24494 13.9561L3.8109 16.9793L5.00697 10.877L0.452479 6.64316L6.62573 5.89498L9.24494 0.255066Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="19"
													height="17"
													viewBox="0 0 19 17"
													fill="none"
												>
													<path
														d="M9.24494 0.255066L11.8641 5.89498L18.0374 6.64316L13.4829 10.877L14.679 16.9793L9.24494 13.9561L3.8109 16.9793L5.00697 10.877L0.452479 6.64316L6.62573 5.89498L9.24494 0.255066Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="10"
													height="17"
													viewBox="0 0 10 17"
													fill="none"
												>
													<path
														d="M3.76369 16.9793L9.19773 13.9561V0.255066L6.57853 5.89498L0.405273 6.64316L4.95977 10.877L3.76369 16.9793Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
										</ul>
										<h5>3.5/5</h5>
									</div>
									<div
										class="pricing-area d-flex align-items-center"
									>
										<div class="current-price">
											৳599
										</div>
										<div class="discount-price">
											৳699
										</div>
										<div class="discount-percent">
											-30%
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-4">
							<a href="#" class="category-product">
								<div class="cat-product-img">
									<img
										src="{{ asset('frontEnd/images/category-p.jpg') }}"
										draggable="false"
										alt="product"
									/>
								</div>
								<div
									class="cat-p-content d-flex flex-column"
								>
									<h4>Gradient Graphic T-shirt</h4>
									<div
										class="rating-area d-flex align-items-center"
									>
										<ul
											class="d-flex align-items-center"
										>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="19"
													height="17"
													viewBox="0 0 19 17"
													fill="none"
												>
													<path
														d="M9.24494 0.255066L11.8641 5.89498L18.0374 6.64316L13.4829 10.877L14.679 16.9793L9.24494 13.9561L3.8109 16.9793L5.00697 10.877L0.452479 6.64316L6.62573 5.89498L9.24494 0.255066Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="19"
													height="17"
													viewBox="0 0 19 17"
													fill="none"
												>
													<path
														d="M9.24494 0.255066L11.8641 5.89498L18.0374 6.64316L13.4829 10.877L14.679 16.9793L9.24494 13.9561L3.8109 16.9793L5.00697 10.877L0.452479 6.64316L6.62573 5.89498L9.24494 0.255066Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="19"
													height="17"
													viewBox="0 0 19 17"
													fill="none"
												>
													<path
														d="M9.24494 0.255066L11.8641 5.89498L18.0374 6.64316L13.4829 10.877L14.679 16.9793L9.24494 13.9561L3.8109 16.9793L5.00697 10.877L0.452479 6.64316L6.62573 5.89498L9.24494 0.255066Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="10"
													height="17"
													viewBox="0 0 10 17"
													fill="none"
												>
													<path
														d="M3.76369 16.9793L9.19773 13.9561V0.255066L6.57853 5.89498L0.405273 6.64316L4.95977 10.877L3.76369 16.9793Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
										</ul>
										<h5>3.5/5</h5>
									</div>
									<div
										class="pricing-area d-flex align-items-center"
									>
										<div class="current-price">
											৳599
										</div>
										<div class="discount-price">
											৳699
										</div>
										<div class="discount-percent">
											-30%
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-4">
							<a href="#" class="category-product">
								<div class="cat-product-img">
									<img
										src="{{ asset('frontEnd/images/category-p.jpg') }}"
										draggable="false"
										alt="product"
									/>
								</div>
								<div
									class="cat-p-content d-flex flex-column"
								>
									<h4>Gradient Graphic T-shirt</h4>
									<div
										class="rating-area d-flex align-items-center"
									>
										<ul
											class="d-flex align-items-center"
										>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="19"
													height="17"
													viewBox="0 0 19 17"
													fill="none"
												>
													<path
														d="M9.24494 0.255066L11.8641 5.89498L18.0374 6.64316L13.4829 10.877L14.679 16.9793L9.24494 13.9561L3.8109 16.9793L5.00697 10.877L0.452479 6.64316L6.62573 5.89498L9.24494 0.255066Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="19"
													height="17"
													viewBox="0 0 19 17"
													fill="none"
												>
													<path
														d="M9.24494 0.255066L11.8641 5.89498L18.0374 6.64316L13.4829 10.877L14.679 16.9793L9.24494 13.9561L3.8109 16.9793L5.00697 10.877L0.452479 6.64316L6.62573 5.89498L9.24494 0.255066Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="19"
													height="17"
													viewBox="0 0 19 17"
													fill="none"
												>
													<path
														d="M9.24494 0.255066L11.8641 5.89498L18.0374 6.64316L13.4829 10.877L14.679 16.9793L9.24494 13.9561L3.8109 16.9793L5.00697 10.877L0.452479 6.64316L6.62573 5.89498L9.24494 0.255066Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="10"
													height="17"
													viewBox="0 0 10 17"
													fill="none"
												>
													<path
														d="M3.76369 16.9793L9.19773 13.9561V0.255066L6.57853 5.89498L0.405273 6.64316L4.95977 10.877L3.76369 16.9793Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
										</ul>
										<h5>3.5/5</h5>
									</div>
									<div
										class="pricing-area d-flex align-items-center"
									>
										<div class="current-price">
											৳599
										</div>
										<div class="discount-price">
											৳699
										</div>
										<div class="discount-percent">
											-30%
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-4">
							<a href="#" class="category-product">
								<div class="cat-product-img">
									<img
										src="{{ asset('frontEnd/images/category-p.jpg') }}"
										draggable="false"
										alt="product"
									/>
								</div>
								<div
									class="cat-p-content d-flex flex-column"
								>
									<h4>Gradient Graphic T-shirt</h4>
									<div
										class="rating-area d-flex align-items-center"
									>
										<ul
											class="d-flex align-items-center"
										>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="19"
													height="17"
													viewBox="0 0 19 17"
													fill="none"
												>
													<path
														d="M9.24494 0.255066L11.8641 5.89498L18.0374 6.64316L13.4829 10.877L14.679 16.9793L9.24494 13.9561L3.8109 16.9793L5.00697 10.877L0.452479 6.64316L6.62573 5.89498L9.24494 0.255066Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="19"
													height="17"
													viewBox="0 0 19 17"
													fill="none"
												>
													<path
														d="M9.24494 0.255066L11.8641 5.89498L18.0374 6.64316L13.4829 10.877L14.679 16.9793L9.24494 13.9561L3.8109 16.9793L5.00697 10.877L0.452479 6.64316L6.62573 5.89498L9.24494 0.255066Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="19"
													height="17"
													viewBox="0 0 19 17"
													fill="none"
												>
													<path
														d="M9.24494 0.255066L11.8641 5.89498L18.0374 6.64316L13.4829 10.877L14.679 16.9793L9.24494 13.9561L3.8109 16.9793L5.00697 10.877L0.452479 6.64316L6.62573 5.89498L9.24494 0.255066Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="10"
													height="17"
													viewBox="0 0 10 17"
													fill="none"
												>
													<path
														d="M3.76369 16.9793L9.19773 13.9561V0.255066L6.57853 5.89498L0.405273 6.64316L4.95977 10.877L3.76369 16.9793Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
										</ul>
										<h5>3.5/5</h5>
									</div>
									<div
										class="pricing-area d-flex align-items-center"
									>
										<div class="current-price">
											৳599
										</div>
										<div class="discount-price">
											৳699
										</div>
										<div class="discount-percent">
											-30%
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-4">
							<a href="#" class="category-product">
								<div class="cat-product-img">
									<img
										src="{{ asset('frontEnd/images/category-p.jpg') }}"
										draggable="false"
										alt="product"
									/>
								</div>
								<div
									class="cat-p-content d-flex flex-column"
								>
									<h4>Gradient Graphic T-shirt</h4>
									<div
										class="rating-area d-flex align-items-center"
									>
										<ul
											class="d-flex align-items-center"
										>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="19"
													height="17"
													viewBox="0 0 19 17"
													fill="none"
												>
													<path
														d="M9.24494 0.255066L11.8641 5.89498L18.0374 6.64316L13.4829 10.877L14.679 16.9793L9.24494 13.9561L3.8109 16.9793L5.00697 10.877L0.452479 6.64316L6.62573 5.89498L9.24494 0.255066Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="19"
													height="17"
													viewBox="0 0 19 17"
													fill="none"
												>
													<path
														d="M9.24494 0.255066L11.8641 5.89498L18.0374 6.64316L13.4829 10.877L14.679 16.9793L9.24494 13.9561L3.8109 16.9793L5.00697 10.877L0.452479 6.64316L6.62573 5.89498L9.24494 0.255066Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="19"
													height="17"
													viewBox="0 0 19 17"
													fill="none"
												>
													<path
														d="M9.24494 0.255066L11.8641 5.89498L18.0374 6.64316L13.4829 10.877L14.679 16.9793L9.24494 13.9561L3.8109 16.9793L5.00697 10.877L0.452479 6.64316L6.62573 5.89498L9.24494 0.255066Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
											<li>
												<svg
													xmlns="http://www.w3.org/2000/svg"
													width="10"
													height="17"
													viewBox="0 0 10 17"
													fill="none"
												>
													<path
														d="M3.76369 16.9793L9.19773 13.9561V0.255066L6.57853 5.89498L0.405273 6.64316L4.95977 10.877L3.76369 16.9793Z"
														fill="#FFC633"
													/>
												</svg>
											</li>
										</ul>
										<h5>3.5/5</h5>
									</div>
									<div
										class="pricing-area d-flex align-items-center"
									>
										<div class="current-price">
											৳599
										</div>
										<div class="discount-price">
											৳699
										</div>
										<div class="discount-percent">
											-30%
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<div
						class="pagination-wrapper d-flex align-items-center justify-content-between"
					>
						<a href="#" class="previous">
							<svg
								xmlns="http://www.w3.org/2000/svg"
								width="20"
								height="21"
								viewBox="0 0 20 21"
								fill="none"
							>
								<path
									d="M15.8337 10.5H4.16699M4.16699 10.5L10.0003 16.3334M4.16699 10.5L10.0003 4.66669"
									stroke="currentColor"
									stroke-width="1.67"
									stroke-linecap="round"
									stroke-linejoin="round"
								/>
							</svg>
							Previous
						</a>
						<ul class="d-flex align-items-center">
							<li><a href="#" class="active">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">...</a></li>
							<li><a href="#">8</a></li>
							<li><a href="#">9</a></li>
							<li><a href="#">10</a></li>
						</ul>
						<a href="#" class="next">
							Next
							<svg
								xmlns="http://www.w3.org/2000/svg"
								width="20"
								height="21"
								viewBox="0 0 20 21"
								fill="none"
							>
								<path
									d="M4.16699 10.5H15.8337M15.8337 10.5L10.0003 4.66669M15.8337 10.5L10.0003 16.3334"
									stroke="currentColor"
									stroke-width="1.67"
									stroke-linecap="round"
									stroke-linejoin="round"
								/>
							</svg>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Call to action -->
	<div class="call-to-action-area text-center">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div
						class="call-to-action-content d-flex align-items-center justify-content-center"
					>
						<p>
							We’d love to hear from you—let’s get in touch!
						</p>
						<a href="#">Contact Us</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
