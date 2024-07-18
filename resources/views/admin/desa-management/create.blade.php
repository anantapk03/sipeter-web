@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Tambah Data Wilayah Kerja</h3>
        </div>
        <form action="{{ route('desa.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputNamaDesa">Nama Desa</label>
                            <input id="inputNamaDesa" type="text" name="desa" class="form-control" required placeholder="Masukan Nama Desa">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputLat">Latitude</label>
                            <input type="text" name="lat" id="lat" class="form-control" required placeholder="Masukan Latitude">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputLon">Longitude</label>
                            <input type="text" name="lng" id="lng" class="form-control" required placeholder="Masukan Longitude">
                        </div>
                    </div>
                </div>
                <div class="alert alert-success mt-2" role="alert">
                    <b>
                    Pusatkan titik maps pada wilayah kerja anda untuk mendapatkan latitude dan longitude!
                    </b>
                </div>
                <div id="map" style="height:300px; width: 950px; margin-left:3%" class="my-3"></div>

                <script>
                    let map;
                    function initMap() {
                        map = new google.maps.Map(document.getElementById("map"), {
                            center: { lat: -6.343457, lng: 108.237177 },
                            zoom: 8,
                            scrollwheel: true,
                        });

                        const cantigi = { lat: -6.343457, lng: 108.237177 };
                        let marker = new google.maps.Marker({
                            position: cantigi,
                            map: map,
                            draggable: true
                        });

                        google.maps.event.addListener(marker,'position_changed',
                            function (){
                                let lat = marker.position.lat()
                                let lng = marker.position.lng()
                                $('#lat').val(lat)
                                $('#lng').val(lng)
                            })

                        google.maps.event.addListener(map,'click',
                        function (event){
                            pos = event.latLng
                            marker.setPosition(pos)
                        })
                    }
                </script>
                <script async src="https://maps.googleapis.com/maps/api/js?key={{ config('GOOGLE_API_KEY_FREE') }}&loading=async&callback=initMap" type="text/javascript"></script>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{ route('desa.index') }}">Kembali</a>
                <script>
                    $("#backConfirmation").click(function () {
                        swal({
                            title: 'Batal Menginputkan Data Pengguna?',
                            text: "Semua perubahan tidak akan disimpan",
                            type: 'warning',
                            buttons:{
                                confirm: {
                                    text: 'Kembali',
                                    className : 'btn btn-danger',
                                },
                                cancel: {
                                    visible: true,
                                    text : 'Lanjutkan Mengisi Data',
                                    className: 'btn btn-success',
                                }
                            }
                            }).then((willConfirm) => {
                            if (willConfirm) {
                                window.location.href = $(this).data('href');
                            }
                        });
                    });
                </script>
            </div>
        </form>
    </div>
@endsection