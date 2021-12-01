@extends('layout.sbadmin')

@section('content')
    <div class="container-fluid">
        <h4>Bandingkan Laptop</h4>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <button class="btn btn-outline-primary" id="btncarilaptop1" data-toggle="modal" data-target="#modalCariLaptop">Cari Laptop</button>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <button class="btn btn-outline-primary" id="btncarilaptop2" data-toggle="modal" data-target="#modalCariLaptop">Cari Laptop</button>
                </div>
            </div>
        </div>

        <table class="table table-bordered" style="table-layout: fixed;">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" colspan="3">#General</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="ram1"></td>
                    <td class="text-center">RAM</td>
                    <td id="ram2"></td>
                </tr>
                <tr>
                    <td id="cam1"></td>
                    <td class="text-center">Camera</td>
                    <td id="cam2"></td>
                </tr>
                <tr>
                    <td id="scr1"></td>
                    <td class="text-center">Screen</td>
                    <td id="scr2"></td>
                </tr>
                <tr>
                    <td id="btr1"></td>
                    <td class="text-center">Battery</td>
                    <td id="btr2"></td>
                </tr>
                <tr>
                    <td id="prc1"></td>
                    <td class="text-center">Price</td>
                    <td id="prc2"></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection 

@section('modal')
    <!-- Modal -->
<div class="modal fade" id="modalCariLaptop" tabindex="-1" aria-labelledby="modalCariLaptopLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCariLaptopLabel">Cari Laptop</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @if (Auth::user())
      <div class="modal-body">
            <div class="form-group">
                <label for="namaLaptop">Nama Laptop</label>
                <input type="text" class="form-control" id="namaLaptop" autocomplete="off">
                    <ul class="list-group">
                    </ul>
                <div id="localSearchSimple"></div>
                <div id="spec">

                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnsave" disabled>Save changes</button>
      </div>
      @else
      <div class="modal-body">
           <p class="text-center">Log In terlebih dahulu untuk bisa menikmati fitur ini!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="/login" class="btn btn-primary">Log In</a>
      </div>
      @endif
      

    </div>
  </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/JsLocalSearch.js') }}"></script>
@endsection

@section('ajax')
    <script>
        $(function(){
            $('#namaLaptop').on('keyup', function(){
                const nama = $('#namaLaptop').val();
                $('.list-group').css('display', 'block');
                if(nama.length == 2){
                    $.ajax({
                        url : "{{ route('kumpulanLaptop') }}",
                        data : {name:nama, '_token': '{{ csrf_token() }}' },
                        method: 'post',
                        success: function (data) {
                            $('.list-group').html(data.msg);
                        }
                    })
                }
                if(nama.length == 0)
                {
                    $('.list-group').css('display', 'none');
                }
            });

            $('#localSearchSimple').jsLocalSearch({
                action:"Show",
                html_search:true,
                mark_text:"marktext"
            });
            
            $('body').on('click','.hasilcari',function(){
                $('#btnsave').removeAttr('disabled');
                const nama = $(this).text();
                const id = $(this).data('id');
                $('#namaLaptop').val(nama);
                $('.list-group').css('display', 'none');
                $.ajax({
                    url:"{{ route('getLaptop') }}",
                    method:"POST",
                    data:{id:id, _token: "{{ csrf_token() }}"},
                    success:function(data)
                    {
                        $('#spec').html(data.msg);
                    }
                })
            })

            $('#btnsave').click(function(){
                const id = $('#idlaptop').data('id');
                $.ajax({
                    url:"{{ route('getLaptopData') }}",
                    method:"POST",
                    data:{id:id, _token: "{{ csrf_token() }}"},
                    success:function(data)
                    {
                        const spec = data.spec.split(";");
                        if($('#ram1').html() == ""){
                            $('#ram1').html(spec[0] + " GB");
                            $('#cam1').html(spec[1] + " MP");
                            $('#scr1').html(spec[2] + " Inch");
                            $('#btr1').html(spec[3] + " mAh");
                            $('#prc1').html(new Intl.NumberFormat().format(data.price));
                        }
                        else{
                            $('#ram2').html(spec[0] + " GB");
                            $('#cam2').html(spec[1] + " MP");
                            $('#scr2').html(spec[2] + " Inch");
                            $('#btr2').html(spec[3] + " mAh");
                            $('#prc2').html(new Intl.NumberFormat().format(data.price));
                        }
                    }
                })
            })
        })
    </script>
@endsection