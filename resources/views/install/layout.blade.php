<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Sharing System Installer</title>

    <link href="{!! asset('assets/admin-lte/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">

    <style>
        body {
            margin-top: 10px;
        }
        .required {
            color:red;
        }
    </style>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container">
    @yield('content')
</div>

<script src="{!! asset('assets/jquery/dist/jquery.min.js') !!}"></script>
<script src="{!! asset('assets/admin-lte/bootstrap/js/bootstrap.min.js') !!}"></script>
@yield('js')
</body>
</html>