@extends('install.layout')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <ul class="list-group">
                <a href="#" class="list-group-item list-group-item-success">
                    <span class="glyphicon glyphicon-home"></span> Welcome <span class="glyphicon glyphicon-check pull-right"></span>
                </a>
                <a href="#" class="list-group-item active"><span class="glyphicon glyphicon-cog"></span> Server Requirements</a>
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
                        <span class="glyphicon glyphicon-cog"></span>
                        Server Requirements Check
                    </h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        @foreach($requirements as $requirement)
                        <li class="list-group-item list-group-item-{!! $requirement['isLoaded'] ? 'success':'danger' !!}">
                            {!! $requirement['text'] !!}
                            <span class="pull-right glyphicon glyphicon-{!! $requirement['isLoaded'] ? 'ok':'remove' !!}"></span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="panel-footer clearfix">
                    @if( ! session()->has('requirements') )
                    <a href="{!! action('InstallController@permissions') !!}" class="btn btn-success pull-right">
                        Next Step <span class="glyphicon glyphicon-arrow-right"></span>
                    </a>
                    @else
                    <p class="text-danger text-center">Please complete server requirements</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop