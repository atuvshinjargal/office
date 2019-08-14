@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        {!! Form::open(['route' => 'users.store','method' => 'POST']) !!}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">User Create</h3>
                <div class="btn-group btn-group-xs pull-right">
                    <button class="btn btn-primary btn-flat" type="submit"><i class="fa fa-save"></i> @lang('task.text.buttons.save')</button>
                    <a class="btn btn-danger btn-flat" href="{!! URL::previous() !!}"><i class="fa fa-remove"></i> @lang('task.text.buttons.cancel')</a>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-6 col-md-push-3">
                    <div class="form-group">
                        <label for="name">@lang('task.text.labels.name')</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="email">@lang('task.text.labels.email')</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="password">@lang('task.text.labels.password')</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">@lang('task.text.labels.password_confirmation')</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="role">@lang('task.text.labels.role')</label>
                        {!! Form::select('role',$roles + ["" => trans('task.text.select_role')],old('role'),['class' => 'form-control','id' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@stop