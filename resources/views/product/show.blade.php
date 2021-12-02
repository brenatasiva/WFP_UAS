@extends('layout.sbadmin')

@section('content')
<!-- Container for the image gallery -->
<div class="containerslide">
    <!-- Full-width images with number text -->
    @php
    $total = count($data['images']);
    $c = 1
    @endphp
    @foreach ($data['images'] as $image)
    <div class="mySlides">
        <div class="numbertext">{{ "$c / $total" }}</div>
        <img src="{{ asset('img') }}/{{ $image->name }}" style="width: 100%">
    </div>
    @php
    $c++
    @endphp
    @endforeach

    <!-- Next and previous buttons -->
    @if ($total > 1)
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
    @endif

    <!-- Thumbnail images -->
    <div class="d-flex justify-content-center">
        @php
        $j = 1
        @endphp
        @foreach ($data['images'] as $image)
        @if ($total > 1)
        <div>
            <img class="demo cursor" src="{{ asset('img') }}/{{ $image->name }}" style="width:100%;"
                onclick="currentSlide({{ $j }})">
        </div>
        @endif
        @php
        $j++
        @endphp
        @endforeach
    </div>
</div>
<div class="row pt-3">
    <div class="col-md-6">
        <div class="jumbotron jumbotron-fluid py-4">
            <div class="container">
                <h3 class="text-center">{{ $data['product']->name }}</h3>
                <h1 class="display-4">Spesifikasi : </h1>
                @if ($data['product']->category->name == 'Laptop')
                @php
                $spec = explode(';',$data['product']->spec);
                @endphp
                <p class="card-text">Ram : {{ $spec[0] }} GB</p>
                <p class="card-text">Camera : {{ $spec[1] }} MP</p>
                <p class="card-text">Screen : {{ $spec[2] }} Inch</p>
                <p class="card-text">Battery : {{ $spec[3] }} mAh</p>
                @else
                @foreach ($data['categories'] as $category)
                @if ($category->name != "Laptop")
                @if ($data['product']->category->name == $category->name)
                @if ($category->type == "accessories")
                <h3>Jenis : {{ $data['product']->category->name }}</h3>
                <p>Tipe : {{ $data['product']->spec }}</p>
                @else
                <h4>{{ $data['product']->category->name }}: <span class="lead">{{ $data['product']->spec }}
                        {{ $category->unit }}</span></h4>
                @endif
                @endif
                @endif
                @endforeach
                @endif
                <p>
                    <h1 class="text-center">Rp{{ number_format($data['product']->price) }}</h1>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="jumbotron py-4">
            <h1 class="display-4">Stock : {{ $data['product']->stock }}</h1>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-success">Add to Cart</a>
                <a class="btn btn-danger" href="#" role="button">Checkout</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">

</div>
@endsection

@section('script')
<script>
    var slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }

</script>
@endsection

@section('style')
<style>
    .containerslide {
        position: relative;
    }

    /* Hide the images by default */
    .mySlides {
        display: none;
    }

    /* Add a pointer when hovering over the thumbnail images */
    .cursor {
        cursor: pointer;
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 40%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    /* Add a transparency effect for thumnbail images */
    .demo {
        opacity: 0.6;
    }

    .active,
    .demo:hover {
        opacity: 1;
    }

</style>
@endsection
