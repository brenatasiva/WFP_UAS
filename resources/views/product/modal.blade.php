<table class="table table-bordered" style="table-layout: fixed;">
    <thead class="thead-dark">
        <tr>
            <th scope="col" colspan="2">{{$name}}</th>
        </tr>
    </thead>
    <tbody>
        <?php $data = explode(';', $data);?>
        <tr>
            <td class="text-center">RAM</td>
            <td>{{$data[0]}} GB</td>
        </tr>
        <tr>
            <td class="text-center">Camera</td>
            <td>{{$data[1]}} MP</td>
        </tr>
        <tr>
            <td class="text-center">Screen</td>
            <td>{{$data[2]}}"</td>
        </tr>
        <tr>
            <td class="text-center">Battery</td>
            <td>{{$data[3]}} mAh</td>
        </tr>
    </tbody>
</table>