@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#com1" data-toggle="tab">Тушаал</a></li>
                <li><a href="#com2" data-toggle="tab">Захирамж</a></li>
                <li><a href="#com3" data-toggle="tab">Шийдвэр</a></li>
                <li class="pull-right">
                </li>
            </ul>
            <div class="tab-content">
                @for($i=1;$i<4;$i++)
                <div class="tab-pane @if ($i==1) active @endif" id="com{{$i}}">
                    <div class="container-fluid">
                        <div class="row table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>Дугаар</th>
                                        <th>Утга</th>
                                        <th>Огноо</th>
                                        <th>Файл</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($commands as $command)
                                    @if ($command->category == $i-1)
                                        <tr>
                                            <td>{{ $command->number }}</td>
                                            <td>{{ $command->name }}</td>
                                            <td>{!! $command->start_date !!}</td>
                                            <td><a href="{{ URL::to('/').'/command/pdf/'.md5($command->id.'13').'.pdf'}}" target="_blank" class="btn btn-info btn-xs">Үзэх</a></td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            @if($paginate = $commands->appends(Input::query())->render())
                            <div class="box-footer">
                                {!! $paginate !!}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#pos1" data-toggle="tab">Мэдээлэл</a></li>
                <li><a href="#pos2" data-toggle="tab">Шуурхай зар</a></li>
                <li class="pull-right">
                </li>
            </ul>
            <div class="tab-content">
                @for($i=1;$i<3;$i++)
                <div class="tab-pane @if ($i==1) active @endif" id="pos{{$i}}">
                    <div class="container-fluid">
                        <div class="row table-responsive">

                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>Гарчиг</th>
                                        <th>Эх сурвалж</th>
                                        <th>Огноо</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    @if ($post->category == $i-1)
                                        <tr>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->source }}</td>
                                            <td>{!! $post->created_at !!}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            @if($paginate = $posts->appends(Input::query())->render())
                            <div class="box-footer">
                                {!! $paginate !!}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="task-modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop