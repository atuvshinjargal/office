@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        {!! Form::open(['route' => 'posts.store','method' => 'POST', 'files'=>true]) !!}
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#create" data-toggle="tab">Шинээр үүсгэх</a></li>
                <li class="pull-right">
                    <div class="btn-group btn-group-xs">
                        <button class="btn btn-primary btn-flat" type="submit"><i class="fa fa-save"></i> @lang('task.text.buttons.save')</button>
                        <a class="btn btn-danger btn-flat" href="{!! URL::previous() !!}"><i class="fa fa-remove"></i> @lang('task.text.buttons.cancel')</a>
                    </div>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="create">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">Гарчиг *</label>
                                    <input type="text" id="title" name="title" class="form-control" value="{!! old('title') !!}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="source">Эх сурвалж *</label>
                                    <input type="text" name="source" id="source" class="form-control" value="{!! old('source') !!}">
                                </div>
                                <div class="form-group">
                                    <label for="category">Хэлбэр *</label>
                                    {!! Form::select('category',$category + ["" => "Хэлбэрээ сонгоно уу"],old('category'),['class' => 'form-control','id' => 'category']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="text">Утга</label>
                                <textarea data-toggle="wysihtml5" name="text" id="text" class="form-control">{!! old('text') !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div><!-- /.tab-pane -->
            </div><!-- /.tab-content -->
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop