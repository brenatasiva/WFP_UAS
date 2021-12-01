@extends('layout.sbadmin')
@section('content')
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Stock</th>
            <th>Price</th>
            <th>Spec</th>
            <th>Brand</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
        <?php 
            $spec = explode(';', $d->spec); 
            $price = number_format($d->price);
        ?>
            <tr>
                <td>{{$d->name}}</td>
                <td>{{$d->stock}}</td>
                <td>
                    @if(Auth::user())
                        {{$price}}
                        @else
                            <?php
                                $price = explode(",", $price);
                                $i = 0;
                                foreach ($price as $p) {
                                    if($i>0)
                                        $price[$i] = 'xxx';
                                    $i++;
                                }
                                echo ($price = implode(',', $price));
                            ?>
                    @endif
                </td>
                <td>
                    @if ($d->category->name != 'Laptop')
                        {{$d->spec}}
                        @if ($d->category->name == 'Ram' || $d->category->name == 'SSD'|| $d->category->name == 'HDD')
                            GB
                            @elseif ($d->category->name == 'Battery')mAh
                        @endif
                        @else
                           <button onclick="showSpec('{{$d->spec}}','{{$d->name}}')" data-toggle="modal" data-target="#modalDetail">Lihat Spec</button>
                    @endif
                    
                </td>
                <td>{{$d->brand->name}}</td>
                <td>
                    @if(Auth::user())
                        <a href="{{url('add-to-cart',$d->id)}}">Add to cart</a>
                    @endif
                </td>
            </tr>
        @endforeach 
    </tbody>
</table>
@endsection

@section('modal')
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetail" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetail">Detail Spec</h5>
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
    function showSpec(spec, name) {
        $.ajax({
            type: 'GET',
            url: '{{route("product.showSpec")}}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'spec': spec,
                'name': name,
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