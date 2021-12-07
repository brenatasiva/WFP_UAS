@extends('layout.sbadmin')

@section('content')
@php
    $categories = $data['categories'];
    $brands = $data['brands'];
@endphp
<div class="container-fluid">
<form class="mt-4" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="name" >Nama Produk</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" >
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="category">Kategori</label>
        <div class="col-sm-10">
            <select class="form-control" id="categorySelect" name="category">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>      
                @endforeach
            </select>
        </div>
    </div>

    <div class="laptop-spec" id="specLaptop">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="spek" >Ram</label>
            <div class="col-sm-10 div-laptop">
                <input type="text" class="form-control" id="ram" name="spek[]" >
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="spek" >Camera</label>
            <div class="col-sm-10 div-laptop">
                <input type="text" class="form-control" id="camera" name="spek[]">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="spek" >Screen</label>
            <div class="col-sm-10 div-laptop">
                <input type="text" class="form-control" id="screen" name="spek[]">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="spek" >Battery</label>
            <div class="col-sm-10 div-laptop">
                <input type="text" class="form-control" id="battery" name="spek[]">
            </div>
        </div>
    </div>
    
    <div class="form-group row" id="specNoLaptop" hidden>
        <label class="col-sm-2 col-form-label" for="spek" id="labelCategory"></label>
        <div class="col-sm-10 div-nolaptop">
            <input type="text" class="form-control" id="spek" name="spek[]" disabled>
        </div>
    </div>

    
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="stok" >Stok</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="stok" name="stock">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="price" >Harga</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="price" name="price" value="">
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="brand">Brand</label>
        <div class="col-sm-10">
            <select class="form-control" id="brand" name="brand">
                @foreach ($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <label for="exampleFormControlFile1">Input Image Product</label>
        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="images[]" multiple>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
            
            <button type="submit" class="btn btn-warning">Create</button>
        </div>
  </div>
</form>
</div>
@endsection

@section('script')
    <script>
        $('#categorySelect').on('change', function() {
            if(this.value == 1){
                $('#specLaptop').show();
                $('#specNoLaptop').hide();
                $('.div-nolaptop input[type=text]').attr("disabled",true)
                $('.div-laptop input[type=text]').removeAttr("disabled")
            }else{
                $('#specLaptop').hide();
                $('#specNoLaptop').removeAttr('hidden');
                $('#specNoLaptop').show();
                $('.div-laptop input[type=text]').attr("disabled",true)
                $('.div-nolaptop input[type=text]').removeAttr("disabled")
                $('#labelCategory').html($("#categorySelect option:selected").text());
            }
        });
    </script>
@endsection