@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Client Management</h3>
            </div>
            <div class="box-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>@lang('task.text.labels.name')</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($clients as $client)
                        <tr>
                            <td>{{ $client->name }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{!! route('clients.show',$client->id) !!}" class="btn btn-info btn-xs btn-flat"><i class="fa fa-tasks"></i> @lang('task.text.buttons.tasks')</a>
                                    <a href="{!! route('clients.login',$client->id) !!}" class="btn btn-default btn-xs btn-flat"><i class="fa fa-sign-in"></i> @lang('task.text.buttons.login')</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2"><p class="text-center">@lang('task.no.record')</p></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if( $paginate = $clients->render() )
            <div class="box-footer">
                {!! $paginate !!}
            </div>
            @endif
        </div>
    </div>
</div>
@stop