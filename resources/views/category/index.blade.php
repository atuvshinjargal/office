@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Categories Management</h3>
                <div class="btn-group btn-group-xs pull-right">
                    <a href="{!! route('categories.create') !!}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> @lang('task.text.buttons.add_category')</a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>@lang('task.text.labels.name')</th>
                            <th>@lang('task.text.labels.description')</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description or '-' }}</td>
                        <td>
                            <div class="btn-group btn-group-xs">
                                <a href="{!! route('categories.edit',$category->id) !!}" class="btn btn-default btn-flat">
                                    <i class="fa fa-edit"></i> @lang('task.text.buttons.edit')
                                </a>
                                <button class="btn btn-danger btn-flat" data-btn-type="delete" data-url="{!! route('categories.destroy',$category->id) !!}" data-toggle="confirmation"><i class="fa fa-trash"></i> @lang('task.text.buttons.delete')</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4"><p class="text-center">@lang('task.text.no.record')</p></td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if($paginate = $categories->render())
            <div class="box-footer">
                {!! $paginate !!}
            </div>
            @endif
        </div>
    </div>
</div>
@stop