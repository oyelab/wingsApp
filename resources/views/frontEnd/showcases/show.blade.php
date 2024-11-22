@extends('frontEnd.layouts.app')
@section('content')
<section class="wings-showcase-wrapper section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="wings-showcase-heading text-center">
                    <h1>{{ $showcase->title }}</h1>
                    <span>Behind the Design</span>
                </div>
            </div>

            <div class="col-12">
                <div class="wings-showcase-banner section-buttom-padding">
                    <img
                        src="{{ $showcase->banner_image_path }}"
                        alt="Showcase Banner"
                        draggable="false"
                        class="img-fluid"
                    />
                </div>
            </div>

            <div class="col-12 text-center">
                <p>{{ $showcase->short_description }}</p>
            </div>
        </div>

        <!-- Showcase Details Loop -->
        @foreach ($showcase->details as $index => $detail)
            <div class="row about-design-bottom">
                <div class="col-md-12">
                    <div class="wings-showcase-about-design d-flex justify-content-between @if($index % 2 == 0) flex-row @else flex-row-reverse @endif">
                        <!-- Heading and Description -->
                        <div class="showcase-about-design-details">
                            <h2>{{ $detail->heading }}</h2>
                            <p>{{ $detail->description }}</p>
                        </div>

                        <!-- Image Slider (Only if there are multiple images) -->
                        <div class="showcase-about-design-image">
                            @if (count($detail->image_paths) > 1)
                                <!-- Bootstrap Carousel for Image Slider -->
                                <div id="carouselExample{{ $detail->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($detail->image_paths as $key => $imagePath)
                                            <div class="carousel-item @if($key === 0) active @endif">
                                                <img src="{{ $imagePath }}" class="d-block w-100" alt="{{ $detail->heading }} Image">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample{{ $detail->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample{{ $detail->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            @else
                                <!-- Single Image, no carousel -->
                                <img src="{{ $detail->image_paths[0] }}" class="d-block w-100" alt="{{ $detail->heading }} Image">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

@endsection