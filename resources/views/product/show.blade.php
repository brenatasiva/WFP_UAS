@extends('layout.sbadmin')

@section('content')
<!-- Container for the image gallery -->
<div class="containerslide">
    <!-- Full-width images with number text -->
    @if (Auth::check())
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
    @if ($total > 1)
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
    @endif
    @else
    <div class="mySlides">
        <div class="numbertext">1</div>
        <img src="{{ asset('img') }}/{{ $data['images'][0]->name }}" style="width: 100%">
    </div>
    @endif
    


    <!-- Thumbnail images -->
    <div class="d-flex justify-content-center">
        @if (Auth::check())
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

        @endif
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
                @if(Auth::user())
                <p>
                    <h1 class="text-center">Rp{{ number_format($data['product']->price) }}</h1>
                </p>
                @else
                @php
                    $price = number_format($data['product']->price);
                    $price = explode(",", $price);
                    if(strlen($price[0]) > 1){
                        if((strlen($price[0]) > 2)){
                            $price[0] = substr($price[0],0,1) . "xx";
                        }else if(count($price) < 3){
                            $price[0] = substr($price[0],0,1) . "x";
                        }
                    }
                    $i = 0;
                    foreach ($price as $p) {
                        if($i>0)
                            $price[$i] = 'xxx';
                        $i++;
                    }
                    $price = implode(',', $price);
                @endphp
                <p>
                    <h1 class="text-center">Rp{{$price}}</h1>
                </p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="jumbotron py-4">
            <h1 class="display-4">Stock : {{ $data['product']->stock }}</h1>
            <hr class="my-4">
            <div class="d-flex align-items-center mb-4">
                <button class="btn btn-outline-success" id="btnmin">-</button>
                <p id="qty" class="px-5 m-0">1</p>
                <button class="btn btn-outline-success" id="btnadd">+</button>
            </div>
            <div class="d-flex justify-content-between">
                <button id="btnaddtocart" class="btn btn-success">Add to Cart</button>
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

@section('ajax')
<script>
    let qty = parseInt($('#qty').html());
    $('#btnadd').click(function(){
        if (qty < {{ $data["product"]->stock }}) {
            qty+=1;
            $('#qty').html(qty);
        }
    });
    $('#btnmin').click(function(){
        if (qty > 1) {
            qty-=1
            $('#qty').html(qty);
        }
    });

    $('#btnaddtocart').click(function(){
        @if (Auth::user())
            $.ajax({
                url : "{{ route('product.addtocart') }}",
                method : 'post',
                data : {quantity : qty , id : {{ $data['product']->id }}, "_token" : '{{ csrf_token() }}' } ,
                success : function(data){
                    Swal.fire(
                        'Good job!',
                        'Berhasil menambahkan ke keranjang!',
                        'success'
                        )
                }
            })
        @else
        Swal.fire(
                'Failed!',
                'Anda harus login terlebih dahulu!',
                'error'
                )
        @endif
    });
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
