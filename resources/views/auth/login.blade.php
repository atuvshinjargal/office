<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Е-оффис систем | нэвтрэх</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="{{ asset("/assets/admin-lte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/assets/admin-lte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>


<body class="hold-transition login-page" style="background-image:url(/img/back.jpg);">
<div class="login-box" >
  <div class="login-logo">
    <a href="../../index2.html"><b>Е</b>-Оффис</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Нэвтрэх</p>
	@include('errors.validator')
    {!! Form::open(['url' => 'login','method' => 'POST']) !!}
       <div class="form-group has-feedback">
	        <input type="email" name="email" class="form-control" placeholder="Е-мэйл" />
	        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	    </div>
	    <div class="form-group has-feedback">
	        <input type="password" name="password" class="form-control" placeholder="Нууц үг" />
	        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	    </div>
	    <div class="row">
	        <div class="col-xs-12">
	            <button type="submit" class="btn btn-primary btn-xs btn-flat pull-right">Нэвтрэх</button>
	        </div><!-- /.col -->
	    </div>
    {!! Form::close() !!}

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.1.4 -->
<script src="{{ asset('assets/admin-lte/plugins/jQuery/jQuery-2.1.4.min.js') }}" type="text/javascript"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('assets/admin-lte/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
