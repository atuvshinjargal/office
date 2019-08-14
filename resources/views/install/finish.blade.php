@extends('install.layout')

@section('content')
<div class="row">
    <div class="col-md-4">
        <ul class="list-group">
            <a href="#" class="list-group-item list-group-item-success">
                <span class="glyphicon glyphicon-home"></span> Welcome
                <span class="glyphicon glyphicon-check pull-right"></span>
            </a>
            <a href="#" class="list-group-item list-group-item-success">
                <span class="glyphicon glyphicon-cog"></span> Server Requirements
                <span class="glyphicon glyphicon-check pull-right"></span>
            </a>
            <a href="#" class="list-group-item list-group-item-success">
                <span class="glyphicon glyphicon-file"></span> Directory Permissions
                <span class="glyphicon glyphicon-check pull-right"></span>
            </a>
            <a href="#" class="list-group-item list-group-item-success">
                <span class="glyphicon glyphicon-folder-close"></span> Database
                <span class="glyphicon glyphicon-check pull-right"></span></a>
            <a href="#" class="list-group-item list-group-item-success">
                <span class="glyphicon glyphicon-wrench"></span> System Configuration
                <span class="glyphicon glyphicon-check pull-right"></span>
            </a>
            <a href="#" class="list-group-item active"><span class="glyphicon glyphicon-check"></span> Finish</a>
        </ul>
    </div>
    <div class="col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-check"></span>
                    Congratulations!
                </h3>
            </div>
            <div class="panel-body">
                <p>The script has been installed and ready to be used.</p>
                <p><br>Default User E-Mail and Password</p>
                <pre><strong>E-Mail</strong>: admin@tss.com<br><strong>Password</strong>: password</pre>
            </div>
            <div class="panel-footer clearfix">
                <a href="{!! action('InstallController@home') !!}" class="btn btn-success pull-right">
                    Home Page
                </a>
            </div>
        </div>
    </div>
</div>
@stop