<html lang="en" class="perfect-scrollbar-on">

<head>
    <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/assets') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('/assets') }}/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Award</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta name="viewport" content="width=device-width">
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('/assets') }}/css/bootstrap.min.css" rel="stylesheet">
    <!--  Material Dashboard CSS    -->
    <link href="{{ asset('/assets') }}/css/material-dashboard.css?v=1.2.1" rel="stylesheet">
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('/assets') }}/css/demo.css" rel="stylesheet">
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/53/5/common.js">
    </script>
    <script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/53/5/util.js">
    </script>
    @stack('css')

</head>

<body class="off-canvas-sidebar sidebar-mini">
    {{-- header --}}
    @if (Request::is('', 'signup'))
        @include('user.layout.header')
    @endif
    <div class="wrapper wrapper-full-page">
        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
        @yield('content')
        {{-- footer --}}


        @include('user.layout.footer')
    </div>


    <script src="{{ asset('/assets') }}/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="{{ asset('/assets') }}/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ asset('/assets') }}/js/material.min.js" type="text/javascript"></script>
    <script src="{{ asset('/assets') }}/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <!-- Library for adding dinamically elements -->
    <script src="{{ asset('/assets') }}/js/arrive.min.js" type="text/javascript"></script>
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('/assets') }}/js/jquery.validate.min.js"></script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src="{{ asset('/assets') }}/js/moment.min.js"></script>
    <!--  Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/ -->
    <script src="{{ asset('/assets') }}/js/chartist.min.js"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('/assets') }}/js/jquery.bootstrap-wizard.js"></script>
    <!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
    <script src="{{ asset('/assets') }}/js/bootstrap-notify.js"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="{{ asset('/assets') }}/js/bootstrap-datetimepicker.js"></script>
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script src="{{ asset('/assets') }}/js/jquery-jvectormap.js"></script>
    <!-- Sliders Plugin, full documentation here: https://refreshless.com/nouislider/ -->
    <script src="{{ asset('/assets') }}/js/nouislider.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('/assets') }}/js/jquery.select-bootstrap.js"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="{{ asset('/assets') }}/js/jquery.datatables.js"></script>
    <!-- Sweet Alert 2 plugin, full documentation here: https://limonte.github.io/sweetalert2/ -->
    <script src="{{ asset('/assets') }}/js/sweetalert2.js"></script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="{{ asset('/assets') }}/js/jasny-bootstrap.min.js"></script>
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="{{ asset('/assets') }}/js/fullcalendar.min.js"></script>
    <!-- Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="{{ asset('/assets') }}/js/jquery.tagsinput.js"></script>
    <!-- Material Dashboard javascript methods -->
    <script src="{{ asset('/assets') }}/js/material-dashboard.js?v=1.2.1"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('/assets') }}/js/demo.js"></script>
    <script type="text/javascript">
        $().ready(function() {
            demo.checkFullPageBackgroundImage();

            setTimeout(function() {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>
    @stack('js')
</body><!--   Core JS Files   -->

</html>
