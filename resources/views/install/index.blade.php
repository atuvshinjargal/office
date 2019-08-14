@extends('install.layout')

@section('content')
<div class="row">
    <div class="col-md-4">
        <ul class="list-group">
            <a href="#" class="list-group-item active"><span class="glyphicon glyphicon-home"></span> Welcome</a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-cog"></span> Server Requirements</a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-file"></span> Directory Permissions</a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-folder-close"></span> Database</a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-wrench"></span> System Configuration</a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-check"></span> Finish</a>
        </ul>
    </div>
    <div class="col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-home"></span>
                    Welcome to the installer..
                </h3>
            </div>
            <div class="panel-body">
                Welcome to the setup wizard, please make sure you edited the .env file before clicking next.
            </div>
            <div class="panel-footer clearfix">
                <a href="{!! action('InstallController@requirements') !!}" class="btn btn-success pull-right">
                    Next Step <span class="glyphicon glyphicon-arrow-right"></span>
                </a>
            </div>
        </div>
    </div>
</div>
@stop