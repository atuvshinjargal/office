<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $title or config('task.title.long') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset("/assets/admin-lte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="{!! asset('assets/admin-lte/plugins/fullcalendar/fullcalendar.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('assets/admin-lte/plugins/fullcalendar/fullcalendar.print.css') !!}" rel="stylesheet" type="text/css" media="print" />
    <link href="{{ asset("/assets/admin-lte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/assets/admin-lte/dist/css/skins/_all-skins.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/assets/admin-lte/dist/css/skins/skin-black-light.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/assets/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{!! asset('css/style.css') !!}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="sidebar-mini skin-blue">
<div class="wrapper">
    @include('layouts.header')
    @include('layouts.sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {{ $title or config('task.title.long') }}
                <small>{{ $description or null }}</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('errors.validator')
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
</div><!-- ./wrapper -->

<script src="{{ asset("/assets/admin-lte/plugins/jQuery/jQuery-2.1.4.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/assets/admin-lte/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/assets/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}" type="text/javascript"></script>
<script src="{{ asset('/assets/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset("/assets/typeahead.js/dist/typeahead.bundle.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/bootstrap-confirmation.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/moment-with-locales.min.js") }}" type="text/javascript"></script>
<script src="{!! asset('assets/admin-lte/plugins/fullcalendar/fullcalendar.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('assets/admin-lte/plugins/fullcalendar/lang-all.js') !!}" type="text/javascript"></script>
<script src="{{ asset("/js/script.js") }}" type="text/javascript"></script>
<script src="{{ asset("/assets/admin-lte/dist/js/app.min.js") }}" type="text/javascript"></script>
@yield('js')
</body>
</html>