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
            <a href="#" class="list-group-item list-group-item-success"><span class="glyphicon glyphicon-folder-close"></span> Database <span class="glyphicon glyphicon-check pull-right"></span></a>
            <a href="#" class="list-group-item active"><span class="glyphicon glyphicon-wrench"></span> System Configuration</a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-check"></span> Finish</a>
        </ul>
    </div>
    <div class="col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-wrench"></span>
                    System Configuration
                </h3>
            </div>
            {!! Form::open(['action' => 'InstallController@systemConfig','method' => 'POST']) !!}
            <div class="panel-body">
                @if( $errors->count() > 0 )
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Warning!</strong>
                    <br>
                    <ul>{!! implode('',$errors->all('<li>:message</li>')) !!}</ul>
                </div>
                @endif
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title-long">Long Title</label>
                        <input type="text" name="title[long]" class="form-control" id="title-long" value="{{ array_get($default,'title.long') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="short-long">Short Title</label>
                        <input type="text" name="title[short]" class="form-control" id="short-long" value="{{ array_get($default,'title.short') }}" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="priority">Priorities</label>
                        <table class="table table-condensed table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Color</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(config('task.priority') as $order => $priority)
                                <tr data-order="{{ $order }}">
                                    <td><input type="text"
                                               data-input-name="order"
                                               class="form-control"
                                               name="priority[{{ $order }}][order]"
                                               value="{{ $order }}" required>
                                    </td>
                                    <td><input type="color"
                                               data-input-name="color"
                                               class="form-control"
                                               name="priority[{{ $order }}][color]"
                                               value="{{ $priority }}" required>
                                    </td>
                                    <td>
                                        <button onclick="removeRow($(this));" class="btn btn-danger btn-block" type="button"><span class="glyphicon glyphicon-remove"></span></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3">
                                        <button type="button" data-toggle="add-priority" class="btn btn-info btn-block pull-right"><span class="glyphicon glyphicon-plus"></span> Add Priority</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel-footer clearfix">
                <button type="submit" class="btn btn-success pull-right">
                    Next Step <span class="glyphicon glyphicon-arrow-right"></span>
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop
@section('js')
<script>
$(function () {
    $('[data-toggle="add-priority"]').on('click', function () {
        var table = $('table tbody');
        var row = table.find('tr:last').clone();
        var order = row.data('order');

        order++;

        row.find('input').each(function () {
            var _this = $(this);
            var name = _this.attr('name');
            var iName = _this.data('input-name');
            var val = '#000000';

            if( iName === 'order' ) {
                val = order;
            }

            _this.val(val).attr('name',name.replace(/\d+/,order)).prop('required',true);
        });

        row.attr('data-order',order);

        table.append(row);
    });

})
removeRow = function (row) {
    var l = $('table tbody tr').length;

    if( l > 1 ) {
        console.log(l);
        row.parent().parent().remove();
    }
}
</script>
@stop