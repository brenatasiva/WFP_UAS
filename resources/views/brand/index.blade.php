@extends('layout.sbadmin')
@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Brand</li>
    </ol>

    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalCreate" onclick="">
        Add Brand
    </button><br><br>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout: fixed;">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; ?>
            @foreach ($data as $d)
            <tr>
                <td>{{$i}}</td>
                <td>{{$d->name}}</td>
                <td class="d-flex justify-content-center">
                    <button onclick="modalEdit({{$d->id}})" class="btn btn-warning" data-toggle="modal" data-target="#modalEditBrand">Edit</button>&nbsp&nbsp
                    @can('crud-permission', $d)
                    <form method="post" action="{{route('brand.destroy', $d->id)}}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-lg"
                            onclick="if(!confirm('Are you sure you want to delete this brand?')){return false;}">Delete</button>
                    </form>
                    @endcan
                </td>
            </tr>
            <?php $i++; ?>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('modal')
<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add New Brand</h4>
            </div>
            <form method="post" action="{{route('brand.store')}}">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp"
                            placeholder="Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditBrand" tabindex="-1" aria-labelledby="modalEditBrand" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditBrand">Edit Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group" id="modalContent">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('ajax')
<script>

    function modalEdit(brandId) {
        $.ajax({
            type: 'POST',
            url: 'formEditBrand',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'brandId': brandId,
            },
            success: function (data) {
                $("#modalContent").html(data.msg);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }

</script>
@endsection
