@extends('frontEnd.layouts.app')
@section('content')
<div class="container-fluid p-0">
  <div class="row no-gutters m-0 d-flex">
	@foreach($showcase->banners_image_path as $imagePath)
	<div class="col-12 p-0">
		<img 
			src="{{ $imagePath }}"
			alt="Showcase Banner"
			class="w-100"
			loading="lazy"
		>
      </div>
    @endforeach
  </div>
</div>
@endsection