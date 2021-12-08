@extends('layout.sbadmin')
@section('content')
<main>
    <div class="container-fluid">
        <ol class="breadcrumb mt-4">
            <li class="breadcrumb-item active">Home</li>
        </ol>
        @php
        $id = 1;
        @endphp
        @foreach ($data as $key => $d)
        <div class="border-top border-bottom">
            <h1 class="h1 text-center my-2"><a href="{{ route('product.showProductCategory',$id) }}"
                    class="text-dark">{{$key}}</a></h1>
            <div class="row p-3 justify-content-around">
                <?php $c = 0; ?>
                @foreach ($d as $product)
                <div class="col-lg-3">
                    <div class="card">
                        <?php $path = $product['imageProduct'][0]; ?>
                        <img src="{{ asset('img') }}/{{$path}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h4 class="card-text">{{ $product['produk']->name }}</h4>
                            <p>Stock : {{$product['produk']->stock}}</p>
                            @if(Auth::user())
                            <p>Harga : {{ number_format($product['produk']->price) }}</p>
                            @else
                            <?php
                                $price = number_format($product['produk']->price);
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
                            ?>
                            <p>Harga : {{ $price }}</p>
                            @endif
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-danger stretched-link"
                                href="{{ route('product.show',$product['produk']->id) }}">View
                                Details</a>
                            <div class="small text-black">
                                <i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <?php $c+=1 ?>
                @if ($c == 3)
                @break
                @endif
                @endforeach
            </div>
        </div>
        @php
        $id += 1;
        @endphp
        @endforeach

    </div>
</main>
@endsection
