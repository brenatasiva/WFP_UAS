<form method="post" action="{{url('user/'.$data->id)}}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="exampleInputEmail1">New Password</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder=""
            name="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
