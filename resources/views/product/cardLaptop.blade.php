<div class="card" style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title" data-id="{{ $data->id }}" id="idlaptop">{{ $data->name }}</h5>

    <?php 
        $spec = explode(';',$data->spec);
    ?>

        <p class="card-text">Ram : {{ $spec[0] }} GB</p>
        <p class="card-text">Camera : {{ $spec[1] }} MP</p>
        <p class="card-text">Screen : {{ $spec[2] }} Inch</p>
        <p class="card-text">Battery : {{ $spec[3] }} mAh</p>
        <h1 class="h1">Harga : {{ number_format($data->price) }}</h1>
  </div>
</div>