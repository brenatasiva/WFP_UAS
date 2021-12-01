@foreach ($data as $d)
<li class="list-group-item">
   <a href="javascript:void(0)" class="hasilcari" data-id="{{ $d->id }}">{{ $d->name }}</a>
</li>
@endforeach