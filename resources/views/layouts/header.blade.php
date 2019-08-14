<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{!! url('/') !!}" class="logo">
        <span class="logo-mini">{!! config('task.title.short') !!}</span>
        <span class="logo-lg">{!! config('task.title.long') !!}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">@lang('task.text.toggle_navigation')</span>
        </a>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-info">{!! $userTasks->openTasks()->count() !!}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">@lang('task.text.have_tasks',['task' => $userTasks->openTasks()->count()])</li>
                        <li>
                            <ul class="menu">
                                @forelse($userTasks->openTasks()->take(4)->get() as $task)
                                <li><!-- Task item -->
                                    <a href="#"><h3>{{ $task->name }}</h3></a>
                                    <div class="progress xs">
                                        <div class="progress-bar" style="width: 100%;background-color: {!! config('task.priority.' . $task->priority) !!}" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                            <span class="sr-only">100% Дууссан</span>
                                        </div>
                                    </div>
                                </li><!-- end task item -->
                                @empty
                                <li>
                                    <a href="#"><h3 class="text-center">@lang('task.no.task')</h3></a>
                                </li>
                                @endforelse
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="{!! route('tasks') !!}">@lang('task.text.view_all_tasks')</a>
                        </li>
                    </ul>
                </li>

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset("/img/default.png") }}" class="user-image" alt="User Image"/>
                        <span class="hidden-xs">{!! auth()->user()->name !!}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{ asset("/img/default.png") }}" class="img-circle" alt="User Image" />
                            <p>
                                {!! auth()->user()->name !!}
                                <small>@lang('task.text.member_since',['date' => auth()->user()->created_at->format('M.Y')])</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{!! route('tasks') !!}" class="btn btn-default btn-xs btn-flat">@lang('task.text.my_tasks')</a>
                            </div>
                            <div class="pull-right">
                                <a href="/logout" class="btn btn-default btn-xs btn-flat">@lang('task.text.logout')</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>