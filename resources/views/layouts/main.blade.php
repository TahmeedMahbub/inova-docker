<!DOCTYPE html>
<!--[if lte IE 9]>
    <html class="lte-ie9" lang="en">
<![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en" ng-app="app">
<!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <meta content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">

    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta content="no" name="msapplication-tap-highlight">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />

    <link href="{{ url('admin/assets/img/favicon-16x16.png') }}" rel="icon" sizes="16x16" type="image/png">
    <link href="'{{ url('admin/assets/img/favicon-32x32.png') }}" rel="icon" sizes="32x32" type="image/png">

    <title>@yield('title')</title>

    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link href="{{ url('admin/bower_components/uikit/css/uikit.almost-flat.min.css') }}" rel="stylesheet">

    <!-- altair admin -->
    <link rel="stylesheet" href="{{ url('admin/assets/css/main.css') }}" media="all">

    <!-- select 2 css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- themes -->
    <link rel="stylesheet" href="{{ url('admin/assets/css/themes/themes_combined.min.css') }}" media="all">

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ url('admin/assets/css/custom.css') }}" media="all">

    <!-- kendo UI -->
    <link rel="stylesheet" href="{{url('admin/bower_components/kendo-ui/styles/kendo.common-material.min.css')}}" />
    <link rel="stylesheet" href="{{url('admin/bower_components/kendo-ui/styles/kendo.material.min.css')}}"
        id="kendoCSS" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.2.1/echarts-en.common.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/sweetalert2/6.4.4/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.4.4/sweetalert2.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
        integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
        crossorigin=""></script>

    <style>
        .uk-form-select {
            color: rgba(0, 0, 0, 0.8) !important;
        }

        span.select2-container {
            z-index: 30;
            width: 100% !important;
        }
    </style>
    @yield('styles')
</head>

<body
    class="{{ (\Request::route()->getName() == 'point_of_sales' || 
            \Request::route()->getName() == 'checkout') ? '' : 'sidebar_main_open' }} sidebar_main_swipe">

    @yield('header')

    @yield('sidebar')

    @yield('top_bar')

    <div id="page_content">
        <div id="page_content_inner">
            @include('inc.alert')
            @yield('content')
            @include('inc.create-contact-modal')
            @include('inc.create-attribute-modal')
            @include('inc.choose-variation-with-attribute-values-modal')
            @include('inc.choose-variation-modal')
        </div>
    </div>

    <!-- google web fonts -->
    <script>
        // WebFontConfig = {
    //     google: {
    //         families: [
    //             'Source+Code+Pro:400,700:latin',
    //             'Roboto:400,300,500,700,400italic:latin'
    //         ]
    //     }
    // };
    // (function() {
    //     var wf = document.createElement('script');
    //     wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
    //         '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    //     wf.type = 'text/javascript';
    //     wf.async = 'true';
    //     var s = document.getElementsByTagName('script')[0];
    //     s.parentNode.insertBefore(wf, s);
    // })();
    </script>



    <!-- common functions -->

    <script src="{{ url('admin/assets/js/common.min.js') }}"></script>
    <!-- uikit functions -->
    <script src="{{ url('admin/assets/js/uikit_custom.js') }}"></script>

    <!-- altair core functions -->
    <script src="{{ url('admin/assets/js/altair_admin_common.min.js') }}"></script>

    {{--<script>
        --}}
{{--altair_forms.parsley_validation_config();--}}
{{--
    </script>--}}
    {{--<script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>--}}
    {{--<script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>--}}


    <script src="{{ url('admin/assets/js/pages/page_contact_list.min.js') }}"></script>

    <!-- datatables -->

    <script src="{{ url('admin/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('admin/bower_components/datatables-buttons/js/dataTables.buttons.js') }}"></script>
    <script src="{{ url('admin/assets/js/custom/datatables/buttons.uikit.js') }}"></script>
    <script src="{{ url('admin/bower_components/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ url('admin/bower_components/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ url('admin/bower_components/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ url('admin/bower_components/datatables-buttons/js/buttons.colVis.js') }}"></script>
    <script src="{{ url('admin/bower_components/datatables-buttons/js/buttons.html5.js') }}"></script>
    <script src="{{ url('admin/bower_components/datatables-buttons/js/buttons.print.js') }}"></script>
    <script src="{{ url('admin/assets/js/custom/datatables/datatables.uikit.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/plugins_datatables.js') }}"></script>


    <script src="{!! asset('admin/assets/js/ion.rangeSlider.min.js') !!}"></script>

    <!--  forms advanced functions -->
    <script src="{!! asset('admin/assets/js/pages/forms_advanced.js') !!}"></script>
    <script src="{!! asset('admin/assets/js/pages/redeyeCustom.js') !!}"></script>

    <!-- Kendoui function -->
    <script src="{{ url('admin/assets/js/kendoui_custom.min.js')}}"></script>
    <script src="{{ url('admin/assets/js/pages/kendoui.min.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script>
        $('.select2-single-search-dropdown').select2();
    </script>

    @yield('scripts')
    <script>
        $(document).ready(function() {
        clockUpdate();
        setInterval(clockUpdate, 1000);
    })

    function clockUpdate() 
    {
        var date = new Date();
        $('.digital-clock').css({'color': '#fff'});
        function addZero(x) 
        { 
            if (x < 10) { return x='0' + x; } else { return x; } 
        } 
        function twelveHour(x) { if (x> 12) {
                return x = x - 12;
                } 
                else if (x == 0) {
                    return x = 12;
                } 
                else 
                {
                    return x;
                }
            }

            var h = addZero(twelveHour(date.getHours()));
            var m = addZero(date.getMinutes());
            var s = addZero(date.getSeconds());

            if (h >= 12) {
                var ampm = 'AM';
            }else{
                var ampm = 'PM';
            }

            $('.digital-clock').text(h + ':' + m + ':' + s +' '+ ampm);
    }
    </script>
    <script type="text/javascript">
        $.get("{{route('settings_hide_show_list_ajax')}}/", function(data){

        $.each(data.hide_show_list_sidebar, function(i, data_val)
        {
            var sidebarId = data_val.sidebar_id;

            $('#'+sidebarId).css('display', 'none');
        });

        $.each(data.hide_show_list_report, function(i, data_val)
        {
            var sidebarId = data_val.sidebar_id;

            $('#'+sidebarId).css('display', 'none');
        });

        $.each(data.hide_show_list_fields, function(i, data_val)
        {
            var sidebarId = data_val.sidebar_id;

            $('#'+sidebarId).css('display', 'none');
        });

    });
    </script>

    <!-- custom functions -->
    <script src="{{ url('admin/assets/js/custom.js') }}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    {{--//for angular js--}}
    <script src="{{url('angular/angular.min.js')}}"></script>
    @yield('angular')

</body>

</html>