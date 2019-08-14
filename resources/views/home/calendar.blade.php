@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-3">
        <h3 class="text-center">Бүх үүрэг даалгаврууд</h3>
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{!! array_get($information,'total') !!}</h3>
                <p>@lang('task.text.my_tasks')</p>
            </div>
            <div class="icon">
                <i class="fa fa-tasks"></i>
            </div>
        </div>
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{!! array_get($information,'open') !!}</h3>
                <p>@lang('task.text.open_tasks')</p>
            </div>
            <div class="icon">
                <i class="fa fa-check-square-o"></i>
            </div>
        </div>
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{!! array_get($information,'completed') !!}</h3>
                <p>@lang('task.text.completed_tasks')</p>
            </div>
            <div class="icon">
                <i class="fa fa-check"></i>
            </div>
        </div>
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{!! array_get($information,'closed') !!}</h3>
                <p>@lang('task.text.closed_tasks')</p>
            </div>
            <div class="icon">
                <i class="fa fa-remove"></i>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('task.text.calendar')</h3>
            </div>
            <div class="box-body">
                <div data-toggle="calendar" data-url="{!! route('home.calendar.tasks') !!}"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="task-modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content"></div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop