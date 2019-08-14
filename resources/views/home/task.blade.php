<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">{{ $task->name }}</h4>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#task" data-toggle="tab">@lang('task.text.task')</a></li>
                        <li><a href="#notes" data-toggle="tab">@lang('task.text.notes')</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="task">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Нэр</label>
                                        <p>{{ $task->name }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Ангилал</label>
                                        <p>{{ $task->category->name or '-' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Төлөв</label>
                                        <p>{!! array_get($status,$task->status) !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="priority">Давуу эрх</label>
                                        <p>{!! $task->priority !!}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date">Эхлэх өдөр</label>
                                        <p>{!! $task->start_date->format('d.m.y') !!}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="due_date">Дуусах өдөр</label>
                                        <p>{!! $task->due_date_transform !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Тайлбар</label>
                                        <p>{{ $task->description or '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="notes">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="notes">
                                    @forelse($task->note->sortByDesc('pivot.created_at') as $user)
                                    <div class="form-group">
                                        <label>{{ $user->name }} - <small>{!! $user->pivot->created_at->format('H:i:s d.m.Y') !!}</small></label>
                                        <p>{{ $user->pivot->note }}</p>
                                    </div>
                                    @empty
                                    @endforelse
                                    </div>
                                    @if( ! in_array($task->status,[0,2]) )
                                    {!! Form::open(['route' => ['task.update',$task->id],'method' => 'POST','id' => 'task-update']) !!}
                                    <div class="form-group">
                                        <label for="note">Note</label>
                                        <textarea name="note" id="note" class="form-control"></textarea>
                                    </div>
                                    {!! Form::close() !!}
                                    @endif
                                </div>
                            </div>
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="btn-group btn-group-xs">
        @if( ! in_array($task->status,[0,2]) )
        <button type="button" class="btn btn-success btn-flat" data-toggle="task-complete">
            <i class="fa fa-check"></i> @lang('task.text.buttons.complete')
        </button>
        <button type="button" class="btn btn-primary btn-flat" data-toggle="task-note-save">
            <i class="fa fa-save"></i> @lang('task.text.buttons.save')
        </button>
        @endif
        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">
            <i class="fa fa-remove"></i> @lang('task.text.buttons.close')
        </button>
    </div>
</div>
@if( ! in_array($task->status,[0,2]) )
<script type="text/javascript">
$(function () {
    $('[data-toggle="task-note-save"]').on('click', function () {
        var form = $('#task-update');

        $.post(form.attr('action'),form.serialize() + '&type=note').done(function () {
            $.get(form.attr('action')).done(function (data) {
                var modal = $('#task-modal');
                modal.find('.modal-content').html(data);
                modal.find('a[href="#notes"]').trigger('click');
            });
        });
    });
    $('[data-toggle="task-complete"]').on('click', function () {
        var form = $('#task-update');

        $.post(form.attr('action'),{type:'complete'}).done(function () {
            $.get(form.attr('action')).done(function (data) {
                var modal = $('#task-modal');
                modal.find('.modal-content').html(data);
            });
        });
    });
})
</script>
@endif