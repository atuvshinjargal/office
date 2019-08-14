@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        {!! Form::open(['route' => ['tasks.update',$task->id],'method' => 'PUT']) !!}
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#create" data-toggle="tab">@lang('task.text.tab.task_edit')</a></li>
                <li><a href="#assign" data-toggle="tab">@lang('task.text.tab.assign_client')</a></li>
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
                                    <label for="name">@lang('task.text.labels.name') *</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{!! old('name',$task->name) !!}">
                                </div>
                                <div class="form-group">
                                    <label for="start_date">@lang('task.text.labels.start_date') *</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control" value="{!! old('start_date',$task->start_date->format('Y-m-d')) !!}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="category">@lang('task.text.labels.category')</label>
                                    {!! Form::select('category_id',$categories + ["" => "Please select a category"],old('category_id',$task->category_id),['class' => 'form-control','id' => 'category']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="due_date">@lang('task.text.labels.due_date')</label>
                                    <input type="date" id="due_date" name="due_date" class="form-control" value="{!! old('due_date',$task->due_date->format('Y-m-d')) !!}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">@lang('task.text.labels.status') *</label>
                                    {!! Form::select('status',$status + ["" => "Please select a status"],old('status',$task->status),['class' => 'form-control','id' => 'status']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="priority">@lang('task.text.labels.priority') *</label>
                                    <input type="number" name="priority" id="priority" class="form-control" value="{!! old('priority',$task->priority) !!}" min="{!! head(array_keys(config('task.priority'))) !!}" max="{!! last(array_keys(config('task.priority'))) !!}" placeholder="{!! head(array_keys(config('task.priority'))) !!} - {!! last(array_keys(config('task.priority'))) !!} between">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">@lang('task.text.labels.description')</label>
                                    <textarea data-toggle="wysihtml5" name="description" id="description" class="form-control">{!! old('description',$task->description) !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="assign">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4" id="scrollable-dropdown-menu">
                                <label for="client">@lang('task.text.find_user')</label>
                                {!! Form::text('search',null,['class' => 'form-control','id' => 'client']) !!}
                                <p class="help-block">
                                    @lang('task.text.find_user_help')
                                </p>
                            </div>
                            <div class="col-md-3 col-md-push-2">
                                <label>@lang('task.text.clients')</label>
                                <ul class="list-group" id="client_list">
                                @forelse($task->client as $client)
                                  <li class="list-group-item">
                                      {{ $client->name }}
                                      <input type="hidden" name="clients[]" value="{!! $client->id !!}"/>
                                      <button class="btn btn-danger btn-flat btn-xs pull-right" onclick="$(this).parent().remove()">
                                          <i class="fa fa-remove"></i> @lang('task.text.buttons.remove')
                                      </button>
                                  </li>
                                @empty

                                @endif
                                </ul>
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
@section('js')
<script type="text/javascript">
    $(function () {
        var engine = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '{!! route("tasks.find.client") !!}?query=%QUERY',
                wildcard: '%QUERY'
            }
        });

        $('#client').typeahead({
            hint:false
        }, {
            name: 'clients',
            display: 'name',
            limit:10,
            source: engine
        }).bind('typeahead:select', function (e, object) {
            var li = '<li class="list-group-item">';
            li += object.name;
            li += '<input type="hidden" name="clients[]" value="' + object.id + '"/>';
            li += '<button class="btn btn-danger btn-flat btn-xs pull-right" onclick="$(this).parent().remove()"><i class="fa fa-remove"></i> @lang("task.text.buttons.remove")</button>';
            li += '</li>';

            $('#client_list').append(li);

            $(this).typeahead('val','');
        });
    })
</script>
@stop