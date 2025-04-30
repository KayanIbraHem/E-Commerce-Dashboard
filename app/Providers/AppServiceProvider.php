<?php

namespace App\Providers;

use App\Models\Driver\Driver;
use App\Observers\GlobalObserver;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Models\Scopes\PerOrganizationScope;
use App\Bases\Services\ApiResponseService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('apiresponse', function () {
            return new ApiResponseService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
