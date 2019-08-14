<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">{{ $task->name }}</h4>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="notes">
                    @forelse($task->note->sortByDesc('pivot.created_at') as $user)
                        <div class="form-group">
                            <label>{{ $user->name }} - <small>{!! $user->pivot->created_at->format('H:i:s d.m.Y') !!}</small></label>
                            <p>{{ $user->pivot->note }}</p>
                        </div>
                    @empty
                        <p class="text-center">@lang('task.no.note')</p>
                    @endforelse
                </div>
                {!! Form::open(['route' => ['tasks.note.save',$task->id],'method' => 'POST','id' => 'task-update']) !!}
                <div class="form-group">
                    <label for="note">@lang('task.text.labels.note')</label>
                    <textarea name="note" id="note" class="form-control"></textarea>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="btn-group btn-group-xs">
        <button type="button" class="btn btn-primary btn-flat" data-toggle="task-note-save"><i class="fa fa-save"></i> @lang('task.text.buttons.save')</button>
        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> @lang('task.text.buttons.close')</button>
    </div>
</div>
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