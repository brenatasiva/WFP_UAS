@extends('layout.sbadmin')
@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Fullname</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        @foreach ($data as $d)
        <tr>
            <td>{{$i}}</td>
            <td>{{$d->username}}</td>
            <td>{{$d->fullname}}</td>
            <td>{{$d->status}}</td>
            <td>
                <button onclick="modalReset({{$d->id}})" data-toggle="modal" data-target="#modalResetPassword">Reset
                    Password</button>
                @can('admin-permission', $d)
                <form method="post" action="{{url('user/'.$d->id)}}">
                    @csrf
                    @method('PUT')
                    @if ($d->status == 'active')
                    <button type="submit" class="btn btn-danger btn-lg"
                        onclick="if(!confirm('Are you sure you want to suspend this pegawai?')){return false;}"
                        name="status" value="suspended">Suspend</button>
                    @else
                    <button type="submit" class="btn btn-success btn-lg"
                        onclick="if(!confirm('Are you sure you want to activate this pegawai?')){return false;}"
                        name="status" value="active">Activate</button>
                    @endif
                </form>
                @endcan
            </td>
        </tr>
        <?php 
                $i++
            ?>
        @endforeach
    </tbody>
</table>
@endsection

@section('modal')
<div class="modal fade" id="modalResetPassword" tabindex="-1" aria-labelledby="modalResetPassword" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalResetPassword">Reset Password</h5>
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
    function modalReset(pegawaiId) {
        $.ajax({
            type: 'POST',
            url: 'formResetPassword',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'pegawaiId': pegawaiId,
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
