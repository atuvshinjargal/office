@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Мэдээлэл, шуурхай зар</h3>
                <div class="btn-group btn-group-xs pull-right">
                    <button class="btn btn-default btn-flat btn-xs collapsed" type="button" data-toggle="collapse" data-target="#filter"><i class="fa fa-filter"></i>Шүүх</button>
                    <a href="{!! route('posts.create') !!}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i>Нэмэх</a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Гарчиг</th>
                            <th>Эх сурвалж</th>
                            <th>Огноо</th>
                            <th>Хэлбэр</th>
                            <th>#</th>
                        </tr>
                        <tr class="collapse" id="filter" aria-expanded="false">
                            {!! Form::open(['route' => ['posts.index',config('repository.criteria.params.search')],'method' => 'GET','id' => 'task-filter']) !!}
                            <td></td>
                            <td><input name="title" type="text" class="form-control input-sm"></td>
                            <td><input name="source" type="text" class="form-control input-sm"></td>
                            <td><input name="created_at" type="date" class="form-control input-sm"></td>
                            <td>
                                {!! Form::select('category',$category + ["" => "Хэлбэрээ сонгонo уу."],null,['class' => 'form-control input-sm']) !!}
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-default btn-flat" type="submit">
                                        <i class="fa fa-search"></i> @lang('task.text.buttons.search')
                                    </button>
                                    <a href="{!! route('posts.index') !!}" class="btn btn-default btn-flat">
                                        <i class="fa fa-remove"></i> @lang('task.text.buttons.clear')
                                    </a>
                                </div>
                            </td>
                            {!! Form::close() !!}
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>
                            <a href="#row{!! $post->id !!}" data-toggle="collapse" class="accordion-toggle collapsed" aria-expanded="false">
                                <i class="fa fa-plus"></i>
                            </a>
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->source }}</td>
                        <td>{!! $post->created_at !!}</td>
                        <td>{!! array_get($category,$post->category) !!}</td>
                        <td>
                            <div class="btn-group btn-group-xs">
                                <a href="{!! route('posts.edit',$post->id) !!}" class="btn btn-default btn-flat">
                                    <i class="fa fa-edit"></i> @lang('task.text.buttons.edit')
                                </a>
                                <button class="btn btn-danger btn-flat" data-btn-type="delete" data-url="{!! route('posts.destroy',$post->id) !!}" data-toggle="confirmation"><i class="fa fa-trash"></i> @lang('task.text.buttons.delete')</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($paginate = $posts->appends(Input::query())->render())
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