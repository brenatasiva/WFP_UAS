<a class="nav-link" href="{{url('product/category',1)}}">
    <div class="sb-nav-link-icon"><i class="fas fa-laptop"></i></div>Laptop
</a>

<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSparepart" aria-expanded="false"
    aria-controls="collapseSparepart">
    <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
    Sparepart
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseSparepart" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        @foreach ($data as $d)
        @if ($d->type=='sparepart')
        <a class="nav-link" href="{{url('product/category',$d->id)}}">{{$d->name}}</a>
        @endif
        @endforeach
    </nav>
</div>
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAccessories" aria-expanded="false"
    aria-controls="collapseAccessoriess">
    <div class="sb-nav-link-icon"><i class="fas fa-paperclip"></i></div>
    Accessories
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseAccessories" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        @foreach ($data as $d)
        @if ($d->type=='accessories')
        <a class="nav-link" href="{{url('product/category',$d->id)}}">{{$d->name}}</a>
        @endif
        @endforeach
    </nav>
</div>
