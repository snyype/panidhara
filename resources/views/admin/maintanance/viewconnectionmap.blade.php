
@extends('admin.dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="container">


                    <h3 class="box-title">Map View</h3>
                    <div class="table-responsive">
                        <div id="map" style="height:400px; width: 800px;" class="my-3"></div>

                        <script>
                            let map;
                            function initMap() {
                                map = new google.maps.Map(document.getElementById("map"), {
                                    center: { lat: {{$data->latitude}}, lng: {{$data->longitude}} },
                                    zoom: 8,
                                    scrollwheel: true,
                                  
                                });
                                const uluru = { lat: {{$data->latitude}}, lng: {{$data->longitude}}  };
                                let marker = new google.maps.Marker({
                                    position: uluru,
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
                        <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"
                                type="text/javascript"></script>
                    </div>
                        <a href="https://maps.google.com/?q={{$data->latitude}},{{$data->longitude}}"  target="_blank"><button class="btn btn-danger">Get Directions</button></a>
                    </div><br><br>


</div>
            </div>
        </div>
    </div>
</div>


@endsection