@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['route' => ['categories.update',$category->id],'method' => 'PUT']) !!}
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Category Update</h3>
                    <div class="btn-group btn-group-xs pull-right">
                        <button class="btn btn-primary btn-flat" type="submit"><i class="fa fa-save"></i> @lang('task.text.buttons.save')</button>
                        <a class="btn btn-danger btn-flat" href="{!! URL::previous() !!}"><i class="fa fa-remove"></i> @lang('task.text.buttons.cancel')</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-md-6 col-md-push-3">
                        <div class="form-group">
                            <label for="name">@lang('task.text.labels.name')</label>
                            <input type="text" id="name" name="name" class="form-control" value="{!! old('name',$category->name) !!}">
                        </div>
                        <div class="form-group">
                            <label for="name">@lang('task.text.labels.description')</label>
                            <textarea name="description" id="description" class="form-control" rows="4">{!! old('description',$category->description) !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop