@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Users Management</h3>
                <div class="btn-group btn-group-xs pull-right">
                    <a href="{!! route('users.create') !!}" class="btn btn-primary btn-flat"><i class="fa fa-user-plus"></i> @lang('task.text.buttons.add_user')</a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>@lang('task.text.labels.name')</th>
                            <th>@lang('task.text.labels.role')</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->roles->first()->name }}</td>
                        <td>
                        <div class="btn-group btn-group-xs">
                            <a href="{!! route('users.edit',$user->id) !!}" class="btn btn-default btn-flat">
                                <i class="fa fa-edit"></i> @lang('task.text.buttons.edit')
                            </a>
                            <button class="btn btn-danger btn-flat" data-btn-type="delete" data-url="{!! route('users.destroy',$user->id) !!}" data-toggle="confirmation"><i class="fa fa-trash"></i> @lang('task.text.buttons.delete')</button>
                        </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">@lang('task.no.record')</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if( $paginate = $users->render() )
            <div class="box-footer">
                {!! $paginate !!}
            </div>
            @endif
        </div>
    </div>
</div>
@stop