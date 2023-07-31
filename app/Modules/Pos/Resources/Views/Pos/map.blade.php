@extends('layouts.main')

@section('title', 'Invoice')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('styles')
    <style>
        .uk-form-select{
            color:rgba(0, 0, 0, 0.8) !important;


        }
        .styled-select select {
            background: transparent;
            border: none;
            font-size: 18px;
            height: 29px;
            padding: 5px; /* If you add too much padding here, the options won't show in IE */
            width: 90%;

        }
        #map{
        height:500px;width:100% 
        }
        #map{ z-index:1; }
#

        .styled-select.slate {
            {{--background: url({{ asset('admin/assets/icons/arrow_down.jpg') }}) no-repeat right center;--}}
            height: 34px;
            width: 240px;
            z-index: 10;
        }

        .styled-select.slate select {

            border-bottom: 1px solid #ccc;
            font-size: 16px;
            height: 34px;
            width: 268px;
        }
        .styled-select.slate option{
            font-size: 16pt;

        }
        .modal{
            width:100%;
            height:900px;
        }
        .slate   { background-color: #ddd; }
        .slate select   { color: #000; }
        @media screen and (-webkit-min-device-pixel-ratio:0)
        {
            .styled-select.slate {
                background: url({{ asset('admin/assets/icons/arrow_down.jpg') }}) no-repeat right center;

            }
        }
        #googleMap {
          height: 300px;
          width: 500px;
        }
    </style>
@endsection
@section('content')
   <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">

                    <div class="md-card">
               <div style="width:300px" id="map"> 
               
               </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
   
   
@endsection

@section('scripts')
  <script>
        $('#sidebar_point_of_sell_index').addClass('act_item');
        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');

        })
        $('.delete_btn').click(function () {
            var id = $(this).next('.invoice_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/invoice/delete/"+id;
            })
        })
  </script>
 
  <script>
    
   
   $(document).ready(function(){
      var lat1    = "{{$lat}}";
      var lat2    = "{{$long}}";
         var map = L.map('map', {
      center: [[lat1, lat2]],
      scrollWheelZoom: true,
    //   inertia: true,
    //   inertiaDeceleration: 2000
    });
    map.setView([lat1, lat2], 15);
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://mapbox.com">Mapbox</a>',
        minZoom: 2,
      maxZoom: 20,
        id: 'superpikar.n28afi10',
        accessToken: 'pk.eyJ1Ijoic3VwZXJwaWthciIsImEiOiI0MGE3NGQ2OWNkMzkyMzFlMzE4OWU5Yjk0ZmYzMGMwOCJ9.3bGFHjoSXB8yVA3KeQoOIw'
    }).addTo(map);
      
     
      console.log(lat1,lat2);
                  L.marker([lat1, lat2])
                .bindPopup('asad')
                .addTo(map);

    });
   
   
</script>

</script>
@endsection
