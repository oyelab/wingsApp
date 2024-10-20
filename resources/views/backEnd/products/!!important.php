
public function update(Request $request, Product $product)
	{
		$slug = Str::slug($request->title);

		// Validate the input
		$request->validate([
			'title' => [
				'required',
				'string',
				'max:255',
				function ($attribute, $value, $fail) use ($slug, $product) {
					// Check if the title already exists for another product
					$existingTitle = Product::where('title', $value)->where('id', '!=', $product->id)->first();

					// Check if the slug generated from title already exists for another product
					$existingSlug = Product::where('slug', $slug)->where('id', '!=', $product->id)->first();

					if ($existingTitle) {
						$fail('The title is already taken.');
					}

					if ($existingSlug) {
						$fail('A product with a similar title already exists (slug conflict).');
					}
				}
			],
			'price' => 'required|numeric',
			'sale' => 'nullable|numeric|min:0|max:100',
			'description' => 'required|string',
			'categories' => 'required|array',
			'categories.*' => 'exists:categories,id',
			'quantities' => 'required|array',
			'quantities.*' => 'nullable|numeric|min:0',
			'specifications' => 'nullable|array',
			'specifications.*' => 'exists:specifications,id',
			'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
			'meta_title' => 'nullable|string|max:255',
			'keywords' => 'nullable|array',
			'meta_desc' => 'nullable|string',
			'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
		]);

		// Process the title to create a unique slug for images
		$images = [];

		// Handle the newly uploaded images
		if ($request->hasFile('images')) {
			foreach ($request->file('images') as $index => $image) {
				$imageName = $slug . '-' . ($index + 1) . '.' . $image->getClientOriginalExtension();
				$image->move(public_path('build/images/products'), $imageName);
				$images[] = $imageName;
			}
		}

		// Handle existing images
		$existingImages = $request->input('existing_images', []); // Get existing images from hidden input fields

		// Merge existing images with newly uploaded ones
		$allImages = array_merge($existingImages, $images);
		// return $allImages;
		// Initialize og_image as null by default
		$ogImageName = $product->og_image; // Keep the current OG image

		// Handle OG image if a new one is uploaded
		if ($request->hasFile('og_image')) {
			$ogImageName = $slug . '-og.' . $request->file('og_image')->getClientOriginalExtension();
			$request->file('og_image')->move(public_path('build/images/products'), $ogImageName);
		}

		$keywords = !empty($request->keywords) ? json_encode($request->keywords) : null;
		$specifications = !empty($request->specifications) ? json_encode($request->specifications) : null;

		// Get the status from the checkbox
		$status = $request->has('status') ? 1 : 0;

		// Update the product in the database
		$product->update([
			'title' => $request->title,
			'slug' => $slug,
			'price' => $request->price,
			'sale' => $request->sale,
			'description' => $request->description,
			'specifications' => $specifications,
			'images' => json_encode($allImages), // Store all images (existing and new) as JSON
			'meta_title' => $request->meta_title,
			'keywords' => $keywords,
			'meta_desc' => $request->meta_desc,
			'og_image' => $ogImageName, // Save the OG image file name
			'categories' => json_encode($request->categories), // Store category IDs as JSON
			'status' => $status,
		]);

		// Update the quantities in the quantities table
		foreach ($request->quantities as $sizeId => $quantity) {
			Quantity::updateOrCreate(
				['product_id' => $product->id, 'size_id' => $sizeId],
				['quantity' => $quantity]
			);
		}

		return redirect()->route('products.index')->with('success', 'Product updated successfully.');
	}

	
<label> Previous:
	@foreach ($productCategories as $productCategory)
		{{ $productCategory->name }}@if (!$loop->last), @endif
	@endforeach
</label>
<div class="table">
	<table class="table mb-0 table-bordered text-center">
		<thead>
			<tr>
				
				<th>Sizes</th>
				<th>Quantity</th>
			</tr>
		</thead>
		<tbody>
			<tr>	
				<td>
					<select 
						class="form-control" 
						name="sizes"
						id="choices-multiple-remove-button" 
						placeholder="This is a placeholder"
						multiple
					>
						@foreach ($sizes as $size)
						<option value="{{ $size->id }}">{{ $size->name }}</option>
						@endforeach
					</select>
				</td>
				<td>
					<input type="text" name="quantity" class="form-control">
				</td>
			</tr>
		</tbody>
	</table>
</div>

Here is my create form:
<div class="row">
			<div class="col-lg-12">
				<div id="addproduct-accordion" class="custom-accordion">
					<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="product-form">
						@csrf
						<div class="card">
							<a href="#addproduct-productinfo-collapse" class="text-body" data-bs-toggle="collapse" aria-expanded="true" aria-controls="addproduct-productinfo-collapse">
								<div class="p-4">
									<div class="d-flex align-items-center">
										<div class="flex-shrink-0 me-3">
											<div class="avatar">
												<div class="avatar-title rounded-circle bg-primary-subtle text-primary">
													<h5 class="text-primary font-size-17 mb-0">01</h5>
												</div>
											</div>
										</div>
										<div class="flex-grow-1 overflow-hidden">
											<h5 class="font-size-16 mb-1">Product Info</h5>
											<p class="text-muted text-truncate mb-0">Fill all information below</p>
										</div>
										<div class="flex-shrink-0">
											<i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
										</div>
									</div>
								</div>
							</a>
							<div id="addproduct-productinfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
								<div class="p-4 border-top">
									<div class="mb-3">
										<label class="form-label" for="productname">Product Name</label>
										<input id="productname" name="title" placeholder="Enter Product Name" type="text" class="form-control" value="{{ old('title') }}" required>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<div class="mb-3">
												<label class="form-label" for="price">Price</label>
												<input id="price" name="price" placeholder="Enter Price" type="text" class="form-control" value="{{ old('price') }}" required>
											</div>
										</div>

										<div class="col-lg-4">
											<div class="mb-3">
												<label class="form-label" for="categories">Categories</label>
												<div id="categorySelector" class="form-control">
													<span>Select Category</span>
												</div>
												<select id="categories" name="categories[]" class="form-control" multiple style="display: none;">
													@foreach ($categories as $category)
														<option value="{{ $category->id }}" 
															{{ (collect(old('categories'))->contains($category->id)) ? 'selected' : '' }}>
															{{ $category->name }}
														</option>
													@endforeach
												</select>
											</div>
										</div>

									</div>
									
									<div class="mb-0">
										<div class="card">
											<div class="card-header">
												<h4 class="card-title">Enter quantity of each size</h4>
											</div>
											<div class="card-body">
												<div class="table-responsive">
													<table class="table mb-0 table-bordered text-center" style="table-layout: fixed; width: 100%;">
														<thead>
															<tr>
																@foreach ($sizes as $size)
																<th><label for="quantity_{{ $size->id }}">{{ $size->name }}</label></th>
																@endforeach
															</tr>
														</thead>
														<tbody>
															<tr>
																@foreach ($sizes as $size)
																<td>
																<input type="number" class="form-control" name="quantities[{{ $size->id }}]" id="quantity_{{ $size->id }}" min="0">
																</td>
																@endforeach
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>

									<!-- Product Description Field with Quill Editor and Hidden Input -->
									<div class="mb-0">
										<label class="form-label" for="productdesc">Product Description</label>
										<!-- Quill editor container -->
										<div id="summernote"></div>

										<!-- Textarea to store Summernote content -->
    									<textarea id="productdesc" name="description" class="form-control" rows="4" hidden>{{ old('description') }}</textarea>
									</div>
									
									<div class="mt-5">
										<label for="formFileMultiple" class="form-label">Upload Your Photos</label>
										<input class="form-control" for="formFileMultiple" type="file" name="images[]" id="images" value="{{ old('images') }}" multiple required />
									</div>
								</div>
							</div>
						</div>


						<div class="card">
							<a href="#addproduct-metadata-collapse" class="text-body collbodyd" data-bs-toggle="collapse" aria-expanded="false" aria-controls="addproduct-metadata-collapse">
								<div class="p-4">
									<div class="d-flex align-items-center">
										<div class="flex-shrink-0 me-3">
											<div class="avatar">
												<div class="avatar-title rounded-circle bg-primary-subtle text-primary">
													<h5 class="text-primary font-size-17 mb-0">02</h5>
												</div>
											</div>
										</div>
										<div class="flex-grow-1 overflow-hidden">
											<h5 class="font-size-16 mb-1">Meta Data</h5>
											<p class="text-muted text-truncate mb-0">Fill all information below</p>
										</div>
										<div class="flex-shrink-0">
											<i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
										</div>
									</div>
								</div>
							</a>

							<div id="addproduct-metadata-collapse" class="collapse" data-bs-parent="#addproduct-accordion">
								<div class="p-4 border-top">
									<div class="row">
										<div class="col-sm-6">
											<div class="mb-3">
												<label class="form-label" for="metatitle">Meta Title</label>
												<input id="metatitle" name="meta_title" placeholder="Enter Title" type="text" class="form-control" value="{{ old('meta_title') }}">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="mb-3">
												<label class="form-label" for="metakeywords">Meta Keywords</label>
												<input id="metakeywords" class="form-control" placeholder="Enter keywords and press Enter" type="text" value="">
												<div id="keywordContainer" class="keywords"></div> <!-- Container to display keywords -->
											</div>
											<!-- Add a hidden input to store the keywords as a string -->
											<input type="hidden" name="keywords[]" id="hiddenKeywords" value="{{ implode(',', old('keywords', [])) }}">
										</div>
									</div>

									<div class="mb-0">
										<label class="form-label" for="metadescription">Meta Description</label>
										<textarea class="form-control" id="metadescription" name="meta_desc" placeholder="Enter Description" rows="4">{{ old('meta_desc') }}</textarea>
									</div>
									<div class="mt-3">
										<label class="form-label" for="ogImage">Upload Open Graph Image</label>
										<input id="ogImage" name="og_image" type="file" class="form-control" accept="image/*">
										<img id="imagePreview" src="" alt="Image Preview" class="d-none"> <!-- Image preview -->
									</div>
								</div>
							</div>
						</div>

						<div class="mb-4">
							<div class="col">
								<button type="submit" class="btn btn-success w-lg"> <i class="bx bx-file me-1"></i> Save </button>
							</div> <!-- end col -->
						</div> <!-- end row -->
					</form>
				</div>
			</div>
		</div>

Now i need to make an edit form, I've some javascripts code below:
<!-- Add JavaScript to handle the click event -->
		<script>
			document.addEventListener('DOMContentLoaded', function () {
			const categorySelector = document.getElementById('categorySelector');
			const selectElement = document.getElementById('categories');

			// Function to update the category selector with selected options
			function updateCategorySelector() {
				const selectedOptions = Array.from(selectElement.selectedOptions).map(option => option.text);
				categorySelector.innerHTML = selectedOptions.length > 0 ? selectedOptions.join(', ') : 'Select one or more categories from here';
			}

			// Initialize on page load to show already selected categories
			updateCategorySelector();

			// Show the select dropdown when clicking on the custom selector
			categorySelector.addEventListener('click', function () {
				selectElement.style.display = 'block';
				selectElement.focus();
			});

			// Update the category selector when categories are changed
			selectElement.addEventListener('change', function () {
				updateCategorySelector();
			});

			// Hide the select dropdown when clicking outside of it
			document.addEventListener('click', function (event) {
				if (!categorySelector.contains(event.target) && !selectElement.contains(event.target)) {
					selectElement.style.display = 'none';
				}
			});
		});
		</script>
		
		<script>
			document.addEventListener('DOMContentLoaded', function () {
				const inputField = document.getElementById('metakeywords');
				const keywordContainer = document.getElementById('keywordContainer');
				const hiddenKeywords = document.getElementById('hiddenKeywords'); // Hidden input to store keywords
				let keywords = [];

				// Retrieve old keywords from the hidden input and populate the keywords array
				const oldKeywords = hiddenKeywords.value ? hiddenKeywords.value.split(',') : [];
				keywords = oldKeywords.map(keyword => keyword.trim()); // Trim whitespace

				// Populate the keyword container with old keywords
				oldKeywords.forEach(keyword => {
					if (keyword) {
						createKeywordElement(keyword); // Create keyword element for each old keyword
					}
				});

				inputField.addEventListener('keypress', function (e) {
					if (e.key === 'Enter') {
						e.preventDefault(); // Prevent form submission or default behavior

						const value = inputField.value.trim(); // Get input value, trim whitespace

						// If value isn't empty and is unique, add it as a keyword
						if (value && !keywords.includes(value)) {
							keywords.push(value);
							createKeywordElement(value); // Create the visual keyword
							inputField.value = ''; // Clear input after adding keyword
							updateHiddenInput(); // Update hidden input with the new keywords array
						}
					}
				});

				// Function to create a keyword element and append it to the container
				function createKeywordElement(keywordText) {
					const keyword = document.createElement('span');
					keyword.classList.add('keyword', 'badge', 'bg-primary');
					keyword.innerHTML = `${keywordText} <span class="remove-keyword">x</span>`;

					// Add remove functionality
					keyword.querySelector('.remove-keyword').addEventListener('click', function () {
						removeKeyword(keywordText, keyword);
					});

					keywordContainer.appendChild(keyword);
				}

				// Function to remove a keyword from both UI and the keywords array
				function removeKeyword(keywordText, keywordElement) {
					keywords = keywords.filter(keyword => keyword !== keywordText); // Remove from array
					keywordElement.remove(); // Remove from UI
					updateHiddenInput(); // Update hidden input with new array
				}

				// Update hidden input with the current keywords array
				function updateHiddenInput() {
					hiddenKeywords.value = keywords.join(','); // Store keywords as a comma-separated string
				}

				// Image upload preview functionality (if needed)
				const ogImageInput = document.getElementById('ogImage');
				const imagePreview = document.getElementById('imagePreview');

				ogImageInput.addEventListener('change', function () {
					const file = this.files[0];

					if (file) {
						const reader = new FileReader();
						reader.onload = function (e) {
							imagePreview.src = e.target.result; // Set the src of the preview
							imagePreview.classList.remove('d-none'); // Show the image
						}
						reader.readAsDataURL(file); // Read the file as a data URL
					} else {
						imagePreview.src = '';
						imagePreview.classList.add('d-none'); // Hide the image
					}
				});
			});
		</script>



		<!-- Initialize Summernote -->
		<script>
			$(document).ready(function() {
				// Initialize Summernote
				$('#summernote').summernote({
					height: 200,  // Set editor height
					placeholder: 'Enter Product Description',
					callbacks: {
						onChange: function(contents, $editable) {
							// Sync Summernote content to the textarea
							$('#productdesc').val(contents);
						}
					}
				});

				// Set initial content if available from old input
				if ($('#productdesc').val()) {
					$('#summernote').summernote('code', $('#productdesc').val());
				}

				// On form submission, sync Summernote content to the textarea
				$('form').on('submit', function() {
					var content = $('#summernote').summernote('code');
					$('#productdesc').val(content);  // Sync the content to textarea
				});
			});
		</script>

