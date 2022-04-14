<?php

namespace App\Providers;

use App\Services\Contracts\IUserService;
use App\Repositories\Contracts\IUserRepository;
use App\Repositories\user\UserRepository;
use App\Services\user\UserService;

use App\Services\Contracts\IReportService;
use App\Repositories\Contracts\IReportRepository;
use App\Repositories\report\ReportRepository;
use App\Services\report\ReportService;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
            //services
            $this->app->bind(IUserService::class,UserService::class);
            $this->app->bind(IReportService::class,ReportService::class);

            //repositories
            $this->app->bind(IUserRepository::class, UserRepository::class);
            $this->app->bind(IReportRepository::class, ReportRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
