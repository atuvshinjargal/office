<?php

namespace TaskSharing\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $app = $this->app;

        $app->bind('TaskSharing\Repositories\ClientRepository', 'TaskSharing\Repositories\ClientRepositoryEloquent');
        $app->bind('TaskSharing\Repositories\TaskRepository', 'TaskSharing\Repositories\TaskRepositoryEloquent');
        $app->bind('TaskSharing\Repositories\UserRepository', 'TaskSharing\Repositories\UserRepositoryEloquent');
        $app->bind('TaskSharing\Repositories\RoleRepository', 'TaskSharing\Repositories\RoleRepositoryEloquent');
        $app->bind('TaskSharing\Repositories\CategoryRepository', 'TaskSharing\Repositories\CategoryRepositoryEloquent');
        $app->bind('TaskSharing\Repositories\SettingRepository', 'TaskSharing\Repositories\SettingRepositoryEloquent');
        $app->bind('TaskSharing\Repositories\CommandRepository', 'TaskSharing\Repositories\CommandRepositoryEloquent');
        $app->bind('TaskSharing\Repositories\PostRepository', 'TaskSharing\Repositories\PostRepositoryEloquent');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
