@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#my_tasks" data-toggle="tab">@lang('task.text.my_tasks')</a></li>
                <li><a href="#open_tasks" data-toggle="tab">@lang('task.text.open_tasks')</a></li>
                <li><a href="#closed_tasks" data-toggle="tab">@lang('task.text.closed_tasks')</a></li>
                <li><a href="#completed_tasks" data-toggle="tab">@lang('task.text.completed_tasks')</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="my_tasks">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover task-table">
                                    <thead>
                                    <tr>
                                        <th>@lang('task.text.labels.name')</th>
                                        <th>@lang('task.text.labels.category')</th>
                                        <th>@lang('task.text.labels.start_date')</th>
                                        <th>@lang('task.text.labels.due_date')</th>
                                        <th>@lang('task.text.labels.status')</th>
                                        <th>@lang('task.text.labels.priority')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($tasks->get('all') as $task)
                                        <tr data-toggle="modal" data-target="#task-modal" data-url="{!! route('tasks.note',$task->id) !!}" @if(in_array($task->status,[0,2])) style="text-decoration: line-through" @endif>
                                            <td>{{ $task->name }}</td>
                                            <td>{{ $task->category->name or '-' }}</td>
                                            <td>{!! $task->start_date->format('d.m.Y') !!}</td>
                                            <td>{!! $task->due_date_transform !!}</td>
                                            <td>{!! array_get($status,$task->status) !!}</td>
                                            <td><i class="fa fa-circle" style="color: {!! $task->color !!}"></i> {!! $task->priority !!}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                @lang('task.no.task')
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                    @if( $paginate = $tasks->get('all')->render() )
                                        <tfoot>
                                        <tr>
                                            <td colspan="4">{!! $paginate !!}</td>
                                        </tr>
                                        </tfoot>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="open_tasks">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover task-table">
                                    <thead>
                                    <tr>
                                        <th>@lang('task.text.labels.name')</th>
                                        <th>@lang('task.text.labels.start_date')</th>
                                        <th>@lang('task.text.labels.due_date')</th>
                                        <th>@lang('task.text.labels.priority')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($tasks->get('open') as $task)
                                        <tr data-toggle="modal" data-target="#task-modal" data-url="{!! route('tasks.note',$task->id) !!}">
                                            <td>{{ $task->name }}</td>
                                            <td>{!! $task->start_date->format('d.m.Y') !!}</td>
                                            <td>{!! $task->due_date_transform !!}</td>
                                            <td>{!! $task->priority !!}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                @lang('task.no.task')
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                    @if( $paginate = $tasks->get('open')->render() )
                                        <tfoot>
                                        <tr>
                                            <td colspan="4">{!! $paginate !!}</td>
                                        </tr>
                                        </tfoot>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="closed_tasks">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover task-table">
                                    <thead>
                                    <tr>
                                        <th>@lang('task.text.labels.name')</th>
                                        <th>@lang('task.text.labels.start_date')</th>
                                        <th>@lang('task.text.labels.due_date')</th>
                                        <th>@lang('task.text.labels.priority')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($tasks->get('closed') as $task)
                                        <tr data-toggle="modal" data-target="#task-modal" data-url="{!! route('tasks.note',$task->id) !!}">
                                            <td>{{ $task->name }}</td>
                                            <td>{!! $task->start_date->format('d.m.Y') !!}</td>
                                            <td>{!! $task->due_date_transform !!}</td>
                                            <td>{!! $task->priority !!}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                @lang('task.no.task')
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                    @if( $paginate = $tasks->get('open')->render() )
                                        <tfoot>
                                        <tr>
                                            <td colspan="4">{!! $paginate !!}</td>
                                        </tr>
                                        </tfoot>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="completed_tasks">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover task-table">
                                    <thead>
                                    <tr>
                                        <th>@lang('task.text.labels.name')</th>
                                        <th>@lang('task.text.labels.start_date')</th>
                                        <th>@lang('task.text.labels.due_date')</th>
                                        <th>@lang('task.text.labels.priority')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($tasks->get('completed') as $task)
                                        <tr data-toggle="modal" data-target="#task-modal" data-url="{!! route('tasks.note',$task->id) !!}">
                                            <td>{{ $task->name }}</td>
                                            <td>{!! $task->start_date->format('d.m.Y') !!}</td>
                                            <td>{!! $task->due_date_transform !!}</td>
                                            <td>{!! $task->priority !!}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                @lang('task.no.task')
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                    @if( $paginate = $tasks->get('open')->render() )
                                        <tfoot>
                                        <tr>
                                            <td colspan="4">{!! $paginate !!}</td>
                                        </tr>
                                        </tfoot>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.tab-content -->
        </div>
    </div>
</div>
<div class="modal fade" id="task-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop