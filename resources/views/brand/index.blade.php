@extends('layout.sbadmin')
@section('content')
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
                    <button onclick="">Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('modal')
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEdit">Edit Brand</h5>
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
                url: '',
                data: {
                    '_token': '<?php echo csrf_token() ?>',
                    'brandId': brandId,
                },
                success: function(data) {
                    $("#modalContent").html(data.msg);
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        }
    </script>
@endsection