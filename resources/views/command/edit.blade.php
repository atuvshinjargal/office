@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        {!! Form::open(['route' => ['commands.update',$command->id],'method' => 'PUT', 'files'=>true]) !!}
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#create" data-toggle="tab">Засах</a></li>
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
                                    <label for="number">Дугаар *</label>
                                    <input type="text" id="number" name="number" class="form-control" value="{!! old('number',$command->number) !!}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Утга *</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{!! old('name',$command->name) !!}">
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Огноо *</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control" value="{!! old('start_date',date('Y-m-d'),$command->start_date) !!}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pdf">Файл (pdf)</label>
                                    <input type="file" name="pdf" id="pdf" class="form-control" value="{!! old('pdf') !!}"  placeholder="Файлаа оруулна уу">
                                </div>
                                <div class="form-group">
                                    <label for="category">Хэлбэр *</label>
                                    {!! Form::select('category',$category + ["" => "Хэлбэрээ сонгоно уу"],old('category',$command->category),['class' => 'form-control','id' => 'category']) !!}
                                </div>
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