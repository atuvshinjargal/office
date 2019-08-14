@extends('install.layout')

@section('content')
<div class="row">
    <div class="col-md-4">
        <ul class="list-group">
            <a href="#" class="list-group-item list-group-item-success">
                <span class="glyphicon glyphicon-home"></span> Welcome <span class="glyphicon glyphicon-check pull-right"></span>
            </a>
            <a href="#" class="list-group-item list-group-item-success">
                <span class="glyphicon glyphicon-cog"></span> Server Requirements <span class="glyphicon glyphicon-check pull-right"></span>
            </a>
            <a href="#" class="list-group-item list-group-item-success"><span class="glyphicon glyphicon-file"></span> Directory Permissions <span class="glyphicon glyphicon-check pull-right"></span>
            </a>
            <a href="#" class="list-group-item active"><span class="glyphicon glyphicon-folder-close"></span> Database</a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-wrench"></span> System Configuration</a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-check"></span> Finish</a>
        </ul>
    </div>
    <div class="col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-folder-close"></span>
                    Database
                </h3>
            </div>
            <div class="panel-body">
                <form method="GET">
                @if(request()->has(['host','database','username']))
                    <div class="col-md-12">
                        <div class="alert alert-{!! $message['class'] !!} alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ $message['text'] }}
                        </div>
                    </div>
                @endif
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="hostname">Hostname <span class="required">*</span></label>
                        <input name="host" type="text" class="form-control" id="hostname" value="{!! old('host',request('host')) !!}">
                        @if( $errors->has('host') )
                        <p class="help-block">{{ $errors->first('host') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="database-name">Database Name <span class="required">*</span></label>
                        <input name="database" type="text" class="form-control" id="database-name" value="{!! old('database',request('database')) !!}">
                        @if( $errors->has('database') )
                            <p class="help-block">{{ $errors->first('database') }}</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="database-username">Database Username <span class="required">*</span></label>
                        <input name="username" type="text" class="form-control" id="database-username" value="{!! old('username',request('username')) !!}">
                        @if( $errors->has('username') )
                            <p class="help-block">{{ $errors->first('username') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="database-password">Database User Password</label>
                        <input name="password" type="text" class="form-control" id="database-password" value="{!! old('password',request('password')) !!}">
                    </div>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-info pull-right">Test Connection</button>
                </div>
                </form>
            </div>
            <div class="panel-footer clearfix">
                <button id="next" class="btn btn-success pull-right">
                    Next Step <span class="glyphicon glyphicon-arrow-right"></span>
                </button>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
$(function () {
    $('#next').on('click', function () {
        var form = $('form');

        form.attr({
            'method':'POST',
            'action':'{!! action("InstallController@setup") !!}'
        }).append('{!! csrf_field() !!}').submit();
    });
})
</script>
@stop