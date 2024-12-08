@extends('frontEnd.layouts.app')
@section('css')
<style>
	.product-title {
		display: -webkit-box;
		-webkit-line-clamp: 2; /* Truncate after 2 lines */
		-webkit-box-orient: vertical;
		overflow: hidden;
		text-overflow: ellipsis; /* Adds '...' at the end if the title exceeds two lines */
	}

	.breadcrumb-content .disabled {
		color: #6c757d; /* Change the color to a muted tone */
		pointer-events: none; /* Prevent clicking */
		cursor: default; /* Change cursor to show it's not clickable */
	}

	.category-item {
		cursor: pointer; /* Change the cursor to a pointer */
		padding: 5px; /* Optional: adds spacing for better UX */
		display: block; /* Optional: makes the element behave like a block link */
		text-decoration: none; /* Optional: removes underline if needed */
		color: inherit; /* Ensures the text color remains consistent */
	}

	.category-item.active {
        text-decoration: underline;
        font-weight: bold;
    }

</style>
@endsection
@section('content')
<!-- breadcrumb section -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-content">
					<x-breadcrub
						:section="$section"
						:collection="$collection"
						:pagetitle="$pageTitle"
					/>
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
					<div class="top-heading d-flex align-items-center justify-content-between">
						<h2>Filters</h2>
						<i class="bi bi-filter"></i>
					</div>
					<div class="border-line"></div>
					<div class="filter-nav d-flex flex-column">
						@foreach ($categories as $mainCategory)
							@if ($mainCategory->parents->isEmpty())
								<div class="accordion" id="accordion{{ $mainCategory->id }}">
									<div class="accordion-item">
										<h2 class="accordion-header" id="heading{{ $mainCategory->id }}">
											<button class="accordion-button {{ $mainCategoryId == $mainCategory->id ? '' : 'collapsed' }}"
													type="button" data-bs-toggle="collapse"
													data-bs-target="#collapse{{ $mainCategory->id }}"
													aria-expanded="{{ $mainCategoryId == $mainCategory->id ? 'true' : 'false' }}"
													aria-controls="collapse{{ $mainCategory->id }}">
												{{ $mainCategory->title }}
												<i class="bi bi-chevron-down"></i>
											</button>
										</h2>
										<div id="collapse{{ $mainCategory->id }}" class="accordion-collapse collapse {{ $mainCategoryId == $mainCategory->id ? 'show' : '' }}"
											aria-labelledby="heading{{ $mainCategory->id }}" data-bs-parent="#accordion{{ $mainCategory->id }}">
											<div class="accordion-body">
												<div class="items">
													<ul class="filter-category-menu">
														<!-- 'All Items' list item -->
														<li class="category-item {{ $mainCategoryId == $mainCategory->id && !$subCategoryId ? 'active' : '' }}"
															data-main-category-id="{{ $mainCategory->id }}"
															data-category-id="">
															All Items
														</li>

														<!-- Loop through child categories -->
														@foreach ($mainCategory->children as $childCategory)
															<li class="category-item {{ $subCategoryId == $childCategory->id && $mainCategoryId == $mainCategory->id ? 'active' : '' }}"
																data-main-category-id="{{ $mainCategory->id }}"
																data-category-id="{{ $childCategory->id }}">
																{{ $childCategory->title }}
															</li>
														@endforeach
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							@endif
						@endforeach
					</div>

					<!-- <button class="apply_filters">Apply Filter</button> -->
				</div>
			</div>
			<div class="col-lg-9 col-md-8">
				<div class="top-bar d-flex align-items-center justify-content-between">
					<h3>
						@if(request('query'))
							Searching for "{{ request('query') }}" ({{ $productCount }} Results)
						@elseif($subCategoryTitle)
							{{ $subCategoryTitle }} ({{ $productCount }})
						@elseif($categoryTitle)
							{{ $categoryTitle }} ({{ $productCount }})
						@else
							All Products ({{ $productCount }})
						@endif
					</h3>
					<div class="sort-by">
						<div class="custom-select-wrapper">
							<select name="sort" id="sort" onchange="this.form.submit()">
							<!-- Placeholder option -->
								<option selected disabled>Sort By</option> 

								<option value="most-popular" {{ request()->query('sort') == 'most-popular' ? 'selected' : '' }}>
									Most Popular
								</option>
								<option value="oldest" {{ request()->query('sort') == 'oldest' ? 'selected' : '' }}>
									Oldest
								</option>
								<option value="price-low" {{ request()->query('sort') == 'price-low' ? 'selected' : '' }}>
									Price: Low to High
								</option>
								<option value="price-high" {{ request()->query('sort') == 'price-high' ? 'selected' : '' }}>
									Price: High to Low
								</option>
							</select>
							<span class="custom-arrow">
								<i class="bi bi-chevron-down"></i>
							</span>
						</div>
					</div>

				</div>
				
				<div class="row">
				@foreach ($products as $product)
				<div class="col-md-4">
					<div class="product-item">
						<div class="product-img">
							<a href="{{ route('products.details', ['category' => $product->categories->first()->slug, 'subcategory' => $product->subcategory->slug, $product]) }}">
								<img
									src="{{ $product->thumbnail }}"
									class="img-fluid"
									alt="{{ $product->title }}"
									draggable="false"
								/>
							</a>
							<a href="#" class="wishlist-icon" data-product-id="{{ $product->id }}">
								<i class="bi {{ session('wishlist') && in_array($product->id, session('wishlist')) ? 'bi-heart-fill' : 'bi-heart' }} fs-4"></i>
							</a>
						</div>
						<div
							class="product-content d-flex justify-content-between"
						>
							<a href="{{ route('products.details', ['category' => $product->categories->first()->slug, 'subcategory' => $product->subcategory->slug, 'product' => $product->slug]) }}">
								<h3>
									{{ $product->title }}
								</h3>
							</a>
							<div class="product-price">
								@if($product->sale)
                                    <h4 >{{ $product->offerPrice }}</h4>
                                    <h5>{{ $product->price }}</h5>
                                @else
                                    <h4>{{ $product->price }}</h4>
                                @endif
							</div>
						</div>
					</div>
				</div>
					
				@endforeach

				</div>

				<div class="pagination-wrapper d-flex align-items-center justify-content-between">
					<!-- Previous Button -->
					<a href="{{ $products->previousPageUrl() }}" class="previous" 
						@if ($products->onFirstPage()) style="pointer-events: none; opacity: 0.5;" @endif>
						<i class="bi bi-arrow-left"></i> Previous
					</a>

					<!-- Page Numbers -->
					<ul class="d-flex align-items-center">
						@foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
							<li>
								<a href="{{ $url }}" class="{{ $page == $products->currentPage() ? 'active' : '' }}" 
								@if($products->lastPage() === 1) style="pointer-events: none; opacity: 0.5;" @endif>
								{{ $page }}
								</a>
							</li>
						@endforeach
					</ul>

					<!-- Next Button -->
					<a href="{{ $products->nextPageUrl() }}" class="next" 
						@if ($products->hasMorePages() === false) style="pointer-events: none; opacity: 0.5;" @endif>
						Next <i class="bi bi-arrow-right"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script>
document.getElementById('sort').addEventListener('change', function () {
    const sortValue = this.value;
    const urlParams = new URLSearchParams(window.location.search);

    // Add or update the "sort" parameter in the URL
    urlParams.set('sort', sortValue);
    
    // Redirect to the updated URL with the sort parameter
    window.location.search = urlParams.toString();
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoryItems = document.querySelectorAll('.category-item');

        categoryItems.forEach(item => {
            item.addEventListener('click', function () {
                const mainCategoryId = item.getAttribute('data-main-category-id');
                const subCategoryId = item.getAttribute('data-category-id');
                const url = new URL(window.location.href);

                // Remove the page and subCategory query parameters to reset pagination and subcategory
                url.searchParams.delete('page');
                url.searchParams.delete('sort');
                url.searchParams.delete('subCategory');

                // Update query parameters with the selected category
                url.searchParams.set('category', mainCategoryId);

                // If a subcategory is selected, add it to the URL
                if (subCategoryId) {
                    url.searchParams.set('subCategory', subCategoryId);
                }

                // Redirect to the new URL
                window.location.href = url.toString();
            });
        });
    });
</script>

@endsection