@extends('frontEnd.layouts.app')
@section('pageTitle', $showcase->title . ' | ')
@section('pageDescription', $showcase->description)
@section('pageOgImage', $showcase->bannersImagePath[0])  <!-- Image specific to this page -->
@section('content')
<div class="container-fluid p-0">
  <div class="row no-gutters m-0 d-flex">
	@foreach($showcase->bannersImagePath as $imagePath)
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