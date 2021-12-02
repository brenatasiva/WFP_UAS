<form method="post" action="{{url('category/'.$data->id)}}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder=""
            name="name" value="{{$data->name}}">
    </div>
    <div class="form-group">
        <label for="type">Type</label>
        <select name="type">
            <option value="">Laptop</option>
            <option value="sparepart" @if($data->type == 'sparepart') selected @endif>Sparepart</option>
            <option value="accessories" @if($data->type == 'accessories') selected @endif>Accessories</option>
        </select>
    </div>
    <div class="form-group">
        <label for="unit">Unit</label>
        <input type="text" class="form-control" id="unit" aria-describedby="emailHelp" placeholder="" name="unit"
            value="{{$data->unit}}" @if($data->type == 'accessories' || $data->type == 'laptop') disabled @endif>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
