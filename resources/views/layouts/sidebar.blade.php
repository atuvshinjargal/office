<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("/img/default.png") }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <h5 class=""> {!! auth()->user()->name !!} </h5>
                <p>Хүний нөөцийн менежер</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> @lang('task.text.online')</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">@lang('task.text.navigation')</li>
            @if( auth()->user()->level() > 1 )
            <li class="treeview">
                <a href="#"><i class="fa fa-users"></i><span>Мэдээ, мэдээлэл</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{!! route('commands.index') !!}"><i class="fa fa-circle-o"></i>Тушаал захирамж шийдвэр</a></li>
                    <li><a href="{!! route('posts.index') !!}"><i class="fa fa-circle-o"></i>Мэдээлэл, Шуурхай зар</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{!! route('tasks.index') !!}"><i class="fa fa-users"></i><span>@lang('task.title.tasks')</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{!! route('tasks.index') !!}"><i class="fa fa-circle-o"></i>@lang('task.title.tasks')</a></li>
                    <li><a href="{!! route('categories.index') !!}"><i class="fa fa-circle-o"></i> @lang('task.title.categories')</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-users"></i><span>Файлын хэсэг</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{!! route('users.index') !!}"><i class="fa fa-circle-o"></i>Сургалтын материал</a></li>
                    <li><a href="{!! route('roles.index') !!}"><i class="fa fa-circle-o"></i>Програм хангамж</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-users"></i><span>@lang('task.title.user_management')</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{!! route('users.index') !!}"><i class="fa fa-circle-o"></i> @lang('task.title.users')</a></li>
                    <li><a href="{!! route('roles.index') !!}"><i class="fa fa-circle-o"></i> @lang('task.title.roles')</a></li>
                    <li><a href="{!! route('clients.index') !!}"><i class="fa fa-user"></i><span>@lang('task.title.clients')</span></a></li>
                </ul>
            </li>
            @else
            <li class="treeview">
                <a href="#"><i class="fa fa-users"></i><span>Мэдээ, мэдээлэл</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{!! url('/') !!}"><i class="fa fa-circle-o"></i>Тушаал захирамж шийдвэр</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Мэдээлэл</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Шуурхай зар</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-users"></i><span>@lang('task.text.my_tasks')</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{!! route('tasks') !!}"><i class="fa fa-circle-o"></i>Үүрэг даалгавар</a></li>
                    <li><a href="{!! route('calendar') !!}"><i class="fa fa-circle-o"></i>Календарь</a></li>
                </ul>
            </li>
            @endif
            <li class="header">@lang('task.text.priority')</li>
            @foreach(config('task.priority') as $key => $color)
            <li>
                <a href="javascript:void(0)">
                    <i class="fa fa-circle" style="color: {!! $color !!}"></i> <span>{!! $key !!}</span>
                </a>
            </li>
            @endforeach
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>