<table class="table">
    <thead>
        <tr>
            <th scope="col">Product Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        @foreach ($data->product as $d)
        <?php 
                $total += $d->pivot->subtotal; 
            ?>
        <tr>
            <td>{{$d->name}}</td>
            <td>{{number_format($d->pivot->price)}}</td>
            <td>{{number_format($d->pivot->quantity)}}</td>
            <td>{{number_format($d->pivot->subtotal)}}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th>Total:</th>
            <th id="total">{{number_format($total)}}</th>
        </tr>
    </tfoot>
</table>
