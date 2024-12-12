@extends('frontEnd.layouts.app')  <!-- Use your main layout -->

@section('content')


	<div class="container">
		<!-- breadcrumb section -->
		<div class="breadcrumb-section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="breadcrumb-content">
							<x-breadcrub
								:section="$section"
								:collection="$collection"
								:pagetitle="$pagetitle"
							/>
						</div>
					</div>
				</div>
			</div>
		</div>
		@foreach ($sections as $section)
		<div class="section-buttom-padding">
			<div class="col-12">
				<div class="section-banner">
					<a href="{{ route('shop.page', $section->slug ) }}">
						<img
							src="{{ $section->imagePath }}"
							draggable="false"
							class="img-fluid rounded"
							alt="{{ $section->title }}"
						/>
					</a>
				</div>
			</div>
		</div>
		@endforeach
	</div>

@endsection
