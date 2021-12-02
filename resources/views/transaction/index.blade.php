@extends('layout.sbadmin')
@section('content')
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Status</th>
            <th>Total</th>
            
            @if (Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Pegawai')
                <th>User</th>
                <th>Detail</th>
                <th>Action</th>
                @else
                <th>Detail</th>
            @endif
            
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        @foreach ($data as $d)
            <tr>
                <td>{{$i}}</td>
                <td>{{$d->status}}</td>
                <td>{{number_format($d->total)}}</td>
                @if (Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Pegawai')
                    <td>{{$d->user->fullname}}</td>
                    <td><button onclick="showDetail({{$d->id}})" data-toggle="modal" data-target="#modalDetail">Lihat Detail</button></td>
                    <td>
                        <select name="status">
                            <option value="">Pilih Status</option>
                            <option value="diterima">Diterima</option>
                            <option value="ditolak">Ditolak</option>
                            <option value="pending">Pending</option>
                        </select>
                    </td>
                    @else
                    <td><button onclick="showDetail({{$d->id}})" data-toggle="modal" data-target="#modalDetail">Lihat Detail</button></td>
                @endif
            </tr>
            <?php 
                $i++
            ?>
        @endforeach 
    </tbody>
</table>
@endsection

@section('modal')
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetail" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetail">Detail Transaksi</h5>
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
        function showDetail(transactionId) {
            $.ajax({
                type: 'POST',
                url: '{{route("transaction.showDetail")}}',
                data: {
                    '_token': '<?php echo csrf_token() ?>',
                    'transactionId': transactionId,
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