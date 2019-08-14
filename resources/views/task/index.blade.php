@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Үүрэг даалгавар</h3>
                <div class="btn-group btn-group-xs pull-right">
                    <button class="btn btn-default btn-flat btn-xs collapsed" type="button" data-toggle="collapse" data-target="#filter"><i class="fa fa-filter"></i> @lang('task.text.buttons.filter')</button>
                    <a href="{!! route('tasks.create') !!}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> @lang('task.text.buttons.add_task')</a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('task.text.labels.name')</th>
                            <th>@lang('task.text.labels.category')</th>
                            <th>@lang('task.text.labels.start_date')</th>
                            <th>@lang('task.text.labels.due_date')</th>
                            <th>@lang('task.text.labels.status')</th>
                            <th>@lang('task.text.labels.priority')</th>
                            <th>#</th>
                        </tr>
                        <tr class="collapse" id="filter" aria-expanded="false">
                            {!! Form::open(['route' => ['tasks.index',config('repository.criteria.params.search')],'method' => 'GET','id' => 'task-filter']) !!}
                            <td></td>
                            <td><input name="name" type="text" class="form-control input-sm"></td>
                            <td>
                                {!! Form::select('category_id',$categories + ["" => trans('task.text.select_category')],null,['class' => 'form-control input-sm']) !!}
                            </td>
                            <td><input name="start_date" type="date" class="form-control input-sm"></td>
                            <td><input name="due_date" type="date" class="form-control input-sm"></td>
                            <td>
                                {!! Form::select('status',$status + ["" => trans('task.text.select_role')],null,['class' => 'form-control input-sm']) !!}
                            </td>
                            <td><input name="priority" type="number" class="form-control input-sm" min="{!! head(array_keys(config('task.priority'))) !!}" max="{!! last(array_keys(config('task.priority'))) !!}" placeholder="{!! head(array_keys(config('task.priority'))) !!} - {!! last(array_keys(config('task.priority'))) !!}"></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-default btn-flat" type="submit">
                                        <i class="fa fa-search"></i> @lang('task.text.buttons.search')
                                    </button>
                                    <a href="{!! route('tasks.index') !!}" class="btn btn-default btn-flat">
                                        <i class="fa fa-remove"></i> @lang('task.text.buttons.clear')
                                    </a>
                                </div>
                            </td>
                            {!! Form::close() !!}
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($tasks as $task)
                    <tr>
                        <td>
                            <a href="#row{!! $task->id !!}" data-toggle="collapse" class="accordion-toggle collapsed" aria-expanded="false">
                                <i class="fa fa-plus"></i>
                            </a>
                        </td>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->category->name or '-' }}</td>
                        <td>{!! $task->start_date->format('d.m.Y') !!}</td>
                        <td>{!! $task->due_date_transform !!}</td>
                        <td>{!! array_get($status,$task->status) !!}</td>
                        <td>{!! $task->priority !!}</td>
                        <td>
                            <div class="btn-group btn-group-xs">
                                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#task-modal" data-url="{!! route('tasks.note',$task->id) !!}"><i class="fa fa-pencil"></i> Note</button>
                                <a href="{!! route('tasks.edit',$task->id) !!}" class="btn btn-default btn-flat">
                                    <i class="fa fa-edit"></i> @lang('task.text.buttons.edit')
                                </a>
                                <button class="btn btn-danger btn-flat" data-btn-type="delete" data-url="{!! route('tasks.destroy',$task->id) !!}" data-toggle="confirmation"><i class="fa fa-trash"></i> @lang('task.text.buttons.delete')</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="hiddenRow" colspan="8">
                            <div class="collapse" id="row{!! $task->id !!}" aria-expanded="false">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5><strong>@lang('task.text.labels.description')</strong></h5>
                                            <p>{{ $task->description }}</p>
                                        </div>
                                        @if($task->client->count() > 0)
                                        <div class="col-md-6">
                                            <h5><strong>@lang('task.text.clients')</strong></h5>
                                            @foreach($task->client->chunk(4) as $client)
                                            <div class="col-md-6">
                                                <ul class="list-group">
                                                @foreach($client as $user)
                                                    <li class="list-group-item">{{ $user->name }}</li>
                                                @endforeach
                                                </ul>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8"><p class="text-center">@lang('task.no.record')</p></td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if($paginate = $tasks->appends(Input::query())->render())
            <div class="box-footer">
                {!! $paginate !!}
            </div>
            @endif
        </div>
    </div>
</div>
<div class="modal fade" id="task-modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop