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
                    <button>Edit</button>
                    <button>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection