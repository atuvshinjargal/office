@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Тушаал, захирамж, шийдвэр</h3>
                <div class="btn-group btn-group-xs pull-right">
                    <button class="btn btn-default btn-flat btn-xs collapsed" type="button" data-toggle="collapse" data-target="#filter"><i class="fa fa-filter"></i>Шүүх</button>
                    <a href="{!! route('commands.create') !!}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i>Нэмэх</a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Дугаар</th>
                            <th>Утга</th>
                            <th>Огноо</th>
                            <th>Файл</th>
                            <th>Хэлбэр</th>
                            <th>#</th>
                        </tr>
                        <tr class="collapse" id="filter" aria-expanded="false">
                            {!! Form::open(['route' => ['commands.index',config('repository.criteria.params.search')],'method' => 'GET','id' => 'task-filter']) !!}
                            <td></td>
                            <td><input name="number" type="text" class="form-control input-sm"></td>
                            <td><input name="name" type="text" class="form-control input-sm"></td>
                            <td><input name="start_date" type="date" class="form-control input-sm"></td>
                            <td></td>
                            <td>
                                {!! Form::select('category',$category + ["" => "Хэлбэрээ сонгонo уу."],null,['class' => 'form-control input-sm']) !!}
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-default btn-flat" type="submit">
                                        <i class="fa fa-search"></i> @lang('task.text.buttons.search')
                                    </button>
                                    <a href="{!! route('commands.index') !!}" class="btn btn-default btn-flat">
                                        <i class="fa fa-remove"></i> @lang('task.text.buttons.clear')
                                    </a>
                                </div>
                            </td>
                            {!! Form::close() !!}
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($commands as $command)
                    <tr>
                        <td>
                            <a href="#row{!! $command->id !!}" data-toggle="collapse" class="accordion-toggle collapsed" aria-expanded="false">
                                <i class="fa fa-plus"></i>
                            </a>
                        </td>
                        <td>{{ $command->number }}</td>
                        <td>{{ $command->name }}</td>
                        <td>{!! $command->start_date !!}</td>
                        <td><a href="{{ URL::to('/').'/command/pdf/'.md5($command->id.'13').'.pdf'}}" target="_blank" class="btn btn-info btn-xs">Үзэх</a></td>
                        <td>{!! array_get($category,$command->category) !!}</td>
                        <td>
                            <div class="btn-group btn-group-xs">
                                <a href="{!! route('commands.edit',$command->id) !!}" class="btn btn-default btn-flat">
                                    <i class="fa fa-edit"></i> @lang('task.text.buttons.edit')
                                </a>
                                <button class="btn btn-danger btn-flat" data-btn-type="delete" data-url="{!! route('commands.destroy',$command->id) !!}" data-toggle="confirmation"><i class="fa fa-trash"></i> @lang('task.text.buttons.delete')</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($paginate = $commands->appends(Input::query())->render())
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