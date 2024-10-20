<div class="col-lg-4">
											<div class="mb-3">
												<label class="form-label" for="categories">Categories <span class="text-danger">*</span></label>
												<div id="categorySelector" class="form-control">
													<span>Select Category</span>
												</div>
												<select id="categories" name="categories[]" class="form-control" multiple>
													@foreach ($categories as $category)
														<option value="{{ $category->id }}" 
															{{ (collect(old('categories'))->contains($category->id)) ? 'selected' : '' }}>
															{{ $category->title }}
														</option>
													@endforeach
												</select>
											</div>
										</div>