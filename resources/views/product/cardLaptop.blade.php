<?php $img = ""; ?>
@foreach ($image as $imag)
@php
$img = $imag->name
@endphp
@break
@endforeach
<div class="card">
    <img src="{{ asset('img') }}/{{ $img }}" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title" data-id="{{ $product->id }}" id="idlaptop">{{ $product->name }}</h5>

        <?php 
        $spec = explode(';',$product->spec);
    ?>

        <p class="card-text">Ram : {{ $spec[0] }} GB</p>
        <p class="card-text">Camera : {{ $spec[1] }} MP</p>
        <p class="card-text">Screen : {{ $spec[2] }} Inch</p>
        <p class="card-text">Battery : {{ $spec[3] }} mAh</p>
        <h1 class="h1">Harga : {{ number_format($product->price) }}</h1>
    </div>
</div>
