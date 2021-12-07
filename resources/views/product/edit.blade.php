@extends('layout.sbadmin')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@php
    $categories = $data['categories'];
    $brands = $data['brands'];
    $images = $data['images'];
    $product = $data['product'];
@endphp
<div class="container-fluid">
<form class="mt-4" action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="name" >Nama Produk</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name}}">
        </div>
    </div>
    @if ($product->category->name == 'Laptop')
    @php
        $spek = explode(";", $product->spec);
    @endphp
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="spek" >Ram</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="ram" name="spek[]" value="{{ $spek[0] }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="spek" >Camera</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="camera" name="spek[]" value="{{ $spek[1] }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="spek" >Screen</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="screen" name="spek[]" value="{{ $spek[2] }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="spek" >Battery</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="battery" name="spek[]" value="{{ $spek[3] }}">
        </div>
    </div>
    @else
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="stok" >{{ $product->category->name }}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="spek" name="spek[]" value="{{ $product->spec }}">
        </div>
    </div>

    @endif
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="stok" >Stok</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="stok" name="stock" value="{{ $product->stock }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="price" >Harga</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="price" name="price" value="{{ $product->price}}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="category">Kategori</label>
        <div class="col-sm-10">
            <select class="form-control" id="category" name="category">
                @foreach($categories as $category)
                @if ($product->category->name == $category->name)
                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>            
                @endif
                    
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="brand">Brand</label>
        <div class="col-sm-10">
            <select class="form-control" id="brand" name="brand">
                @foreach ($brands as $brand)
                @if ($product->brand->name == $brand->name)
                <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
                @else
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>            
                @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        @foreach ($images as $image)
            <div class="col-lg-3">
                <div>
                    <img src="{{ asset('img') }}/{{$image->name}}" class="img-fluid" alt="...">
                </div>
                <div>
                    <input type="checkbox" name="delete_pic[]" value="{{ $image->id }}">Centang untuk hapus!
                </div>
            </div>
        @endforeach
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Input Image Product</label>
        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="images[]" multiple>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-warning btn-block">Edit</button>
  </div>
</form>

</div>
@endsection