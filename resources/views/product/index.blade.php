@extends('layout.sbadmin')
@section('content')
<main>
<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item active">Products</li>
    </ol>
    @foreach ($categories as $category)
    <div class="border-top border-bottom">
        <h1 class="h1 text-center my-2">{{$category->name}}</h1>
        <div class="row p-3 justify-content-around">
            <?php $c = 0; ?>
            @foreach ($products as $product)
                @if ($product->category->name == $category->name)
                <div class="col-lg-3">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1506197603052-3cc9c3a201bd?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=0754ab085804ae8a3b562548e6b4aa2e" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h4 class="card-text">{{ $product->name }}</h4>
                            @if(Auth::user())
                            <p>Harga : {{ number_format($product->price) }}</p>
                            @else
                                <?php
                                    $price = number_format($product->price);
                                    $price = explode(",", $price);
                                    $i = 0;
                                    foreach ($price as $p) {
                                        if($i>0)
                                            $price[$i] = 'xxx';
                                        $i++;
                                    }
                                    $price = implode(',', $price);
                                    ?>
                            <p>Harga : {{ $price }}</p>
                            @endif
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-danger stretched-link" href="#">View Details</a>
                            <div class="small text-black">
                            <i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <?php $c+=1; ?>
                    @if ($c == 3)
                        @break   
                    @endif
                @endif
            @endforeach
        </div>
    </div>  
    @endforeach
    
</div>
</main>
@endsection