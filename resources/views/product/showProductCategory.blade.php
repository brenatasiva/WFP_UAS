@extends('layout.sbadmin')
@section('content')
<div class="container-fluid">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">{{$data[0]['products']->category->name}}</li>
    </ol>
    <div class="border-top border-bottom">
        <h1 class="h1 text-center my-2">{{$data[0]['products']->category->name }} </h1>
        <div class="row p-3 justify-content-around">
            @foreach ($data as $d)
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <?php $path = $d['images'][0]->name; ?>
                    <img src="{{ asset('img') }}/{{$path}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="card-text">{{ $d['products']->name }}</h4>
                        <p>Stock : {{$d['products']->stock}}</p>
                        @if(Auth::user())
                        <p>Harga : {{ number_format($d['products']->price) }}</p>
                        @else
                        <?php
                                $price = number_format($d['products']->price);
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
                        @can('crud-permission')
                        <a class="small text-danger" href="{{ route('product.edit',$d['products']->id) }}">Edit
                            Details</a>
                        <div>
                            <button class="btn btn-danger" onclick="if(confirm('are you sure delete this record?')){event.preventDefault();
                                                        document.getElementById('delete-form-{{$d['products']->id}}').submit();}
                                                ">
                                {{ __('Delete') }}
                            </button>

                            <form id="delete-form-{{$d['products']->id}}"
                                action="{{ route('product.destroy',$d['products']->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                        @else
                        <a class="small text-danger stretched-link"
                            href="{{ route('product.show',$d['products']->id) }}">View
                            Details</a>
                        <div class="small text-black">
                            <i class="fas fa-angle-right"></i></div>
                        @endcan

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
