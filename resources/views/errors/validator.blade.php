@if(isset($errors) && count($errors) > 0)
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid box-danger">
            <div class="box-header">
                <div class="box-title">Whoops!</div>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div><!-- /.box-tools -->
            </div>
            <div class="box-body">
                <ul>
                    @foreach($errors->all('<li>:message</li>') as $error)
                        {!! $error !!}
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endif