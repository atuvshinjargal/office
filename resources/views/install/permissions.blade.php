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
                <a href="#" class="list-group-item active"><span class="glyphicon glyphicon-file"></span> Directory Permissions</a>
                <a href="#" class="list-group-item"><span class="glyphicon glyphicon-folder-close"></span> Database</a>
                <a href="#" class="list-group-item"><span class="glyphicon glyphicon-wrench"></span> System Configuration</a>
                <a href="#" class="list-group-item"><span class="glyphicon glyphicon-check"></span> Finish</a>
            </ul>
        </div>
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-file"></span>
                        Directory Permissions
                    </h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                    @foreach($directories as $directory => $value)
                    <li class="list-group-item list-group-item-{!! $value['is'] ? 'success':'danger' !!}">
                        {!! $directory !!} @if( !$value['is'] ) - Your directory permission {!! $value['perm'] !!} @endif
                        <span class="pull-right glyphicon glyphicon-{!! $value['is'] ? 'ok':'remove' !!}"></span>
                    </li>
                    @endforeach
                    </ul>
                </div>
                <div class="panel-footer clearfix">
                    @if( !session()->has('permissions') )
                    <a href="{!! action('InstallController@database') !!}" class="btn btn-success pull-right">
                        Next Step <span class="glyphicon glyphicon-arrow-right"></span>
                    </a>
                    @else
                    <p class="text-danger">
                        Please give the necessary permissions to the directories you see on the screen.775 is sufficient. if faced with the same problem again set to 777 (not recommended).
                    </p>
                    <button class="btn btn-info pull-right" onclick="window.location.reload();">
                        Refresh <span class="glyphicon glyphicon-refresh"></span>
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop