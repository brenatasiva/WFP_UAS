@extends('layout.sbadmin')

@section('content')
<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Compare Laptop</li>
    </ol>
    <div class="row">
        <div class="col-lg-6">
            <div class="card p2 mb-2 d-flex flex-column justify-content-around" style="min-height: 25vh;">
                <h3 class="text-center" id="nameL1">Cari Laptop</h3>
                <div id="card1"></div>
                <button class="btn btn-outline-primary btncarilaptop" id="btncarilaptop1" data-toggle="modal"
                    data-target="#modalCariLaptop">Cari Laptop</button>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card p2 mb-2 d-flex flex-column justify-content-around" style="min-height: 25vh;">
                <h3 class="text-center" id="nameL2">Cari Laptop</h3>
                <div id="card2"></div>
                <button class="btn btn-outline-primary btncarilaptop" id="btncarilaptop2" data-toggle="modal"
                    data-target="#modalCariLaptop">Cari Laptop</button>
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
                <td class="text-center" id="ram1"></td>
                <td class="text-center">RAM</td>
                <td class="text-center" id="ram2"></td>
            </tr>
            <tr>
                <td class="text-center" id="cam1"></td>
                <td class="text-center">Camera</td>
                <td class="text-center" id="cam2"></td>
            </tr>
            <tr>
                <td class="text-center" id="scr1"></td>
                <td class="text-center">Screen</td>
                <td class="text-center" id="scr2"></td>
            </tr>
            <tr>
                <td class="text-center" id="btr1"></td>
                <td class="text-center">Battery</td>
                <td class="text-center" id="btr2"></td>
            </tr>
            <tr>
                <td class="text-center" id="prc1"></td>
                <td class="text-center">Price</td>
                <td class="text-center" id="prc2"></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="modalCariLaptop" tabindex="-1" aria-labelledby="modalCariLaptopLabel" aria-hidden="true">
</div>
@endsection

@section('script')
<script src="{{ asset('js/JsLocalSearch.js') }}"></script>
@endsection

@section('ajax')
<script>
    $(function () {
        $('body').on('keyup', '#namaLaptop', function () {
            const nama = $('#namaLaptop').val();
            $('.list-group').css('display', 'block');
            if (nama.length == 2) {
                $.ajax({
                    url: "{{ route('kumpulanLaptop') }}",
                    data: {
                        name: nama,
                        '_token': '{{ csrf_token() }}'
                    },
                    method: 'post',
                    success: function (data) {
                        $('.list-group').html(data.msg);
                    }
                })
            }
            if (nama.length == 0) {
                $('.list-group').css('display', 'none');
            }
        });

        $('#localSearchSimple').jsLocalSearch({
            action: "Show",
            html_search: true,
            mark_text: "marktext"
        });

        $('body').on('click', '.hasilcari', function () {
            $('#btnsave').removeAttr('disabled');
            const nama = $(this).text();
            const id = $(this).data('id');
            $('#namaLaptop').val(nama);
            $('.list-group').css('display', 'none');
            $.ajax({
                url: "{{ route('getLaptop') }}",
                method: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function (data) {
                    $('#spec').html(data.msg);
                }
            });
        });

        let idbtn = "";
        $('.btncarilaptop').click(function () {
            $('#modalCariLaptop').html(`<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
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
                <button type="button" class="btn btn-primary" id="btnsave" disabled data-dismiss="modal">Save
                    changes</button>
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
    </div>`);

            idbtn = $(this)[0].id;
        });

        $('body').on('click', '#btnsave', function () {
            const id = $('#idlaptop').data('id');
            $.ajax({
                url: "{{ route('getLaptopData') }}",
                method: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function (data) {
                    const spec = data.product['spec'].split(";");
                    let item = "";
                    let i = 0;
                    data.img.forEach(e => {
                        if (i == 0) {
                            item += `<div class="carousel-item active">
                                        <img src="{{ asset('img') }}/${e.name}" class="d-block w-100" alt="...">
                                    </div>`;
                        } else {
                            item += `<div class="carousel-item">
                                        <img src="{{ asset('img') }}/${e.name}" class="d-block w-100" alt="...">
                                    </div>`;
                        }
                        i++;
                    });

                    if (idbtn == "btncarilaptop1") {
                        $('#card1').html("");
                        $('#card1').append(`<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    ${item}
                                                </div>
                                                </div>
                                                `);
                        $('#nameL1').html(data.product['name']);
                        $('#ram1').html(spec[0] + " GB");
                        $('#cam1').html(spec[1] +
                            " MP");
                        $('#scr1').html(spec[2] + " Inch");
                        $('#btr1').html(spec[
                            3] + " mAh");
                        $('#prc1').html(new Intl.NumberFormat().format(
                            data.product[
                                'price']));
                    } else if (idbtn == "btncarilaptop2") {
                        if ($('#card1').html() == "") {
                            $('#card1').html("");
                            $('#card1').append(`<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    ${item}
                                                </div>
                                                </div>
                                                
                                                `);
                            $('#nameL1').html(data.product['name']);
                            $('#ram1').html(spec[0] + " GB");
                            $('#cam1').html(spec[1] +
                                " MP");
                            $('#scr1').html(spec[2] + " Inch");
                            $('#btr1').html(spec[
                                3] + " mAh");
                            $('#prc1').html(new Intl.NumberFormat().format(
                                data.product[
                                    'price']));
                        } else {
                            $('#card2').html("");
                            $('#card2').append(`<div id="carouselExampleControls2" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    ${item}
                                                </div>
                                                </div>`);
                            $('#nameL2').html(data.product['name']);
                            $('#ram2').html(spec[0] + " GB");
                            $('#cam2').html(spec[1] + " MP");
                            $('#scr2').html(spec[2] + " Inch");
                            $('#btr2').html(spec[3] + " mAh");
                            $('#prc2').html(new Intl.NumberFormat().format(data
                                .product[
                                    'price']));
                        }
                    }
                }
            })
        })
    })

</script>
@endsection
