@extends('layout.sbadmin')
@section('content')

<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalCreate" onclick="">
    Add category
</button>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
            <td>
                <button onclick="modalEdit({{$d->id}})" data-toggle="modal" data-target="#modalEdit">Edit</button>
                @can('crud-permission', $d)
                <form method="post" action="{{route('category.destroy', $d->id)}}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-lg"
                        onclick="if(!confirm('Are you sure you want to delete this category?')){return false;}">Delete</button>
                </form>
                @endcan
            </td>
        </tr>
        <?php $i++; ?>
        @endforeach
    </tbody>
</table>
@endsection

@section('modal')
<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add New category</h4>
            </div>
            <form method="post" action="{{route('category.store')}}">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="" name="name">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type">
                            <option value="">Pilih tipe</option>
                            <option value="sparepart">Sparepart</option>
                            <option value="accessories">Accessories</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <input type="text" class="form-control" id="unit" aria-describedby="emailHelp" placeholder=""
                            name="unit" id="unit">
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

<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdit">Edit category</h5>
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
    function modalEdit(categoryId) {
        $.ajax({
            type: 'POST',
            url: 'formEditCategory',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'categoryId': categoryId,
            },
            success: function (data) {
                $("#modalContent").html(data.msg);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    };

</script>
@endsection
