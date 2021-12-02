<form method="post" action="{{url('brand/'.$data->id)}}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder=""
            name="name" value="{{$data->name}}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
