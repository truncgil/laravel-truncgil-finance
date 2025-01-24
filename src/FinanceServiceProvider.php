<?php

namespace Truncgil\Finance;

use Illuminate\Support\ServiceProvider;

class FinanceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/finance.php', 'finance'
        );

        $this->app->singleton('finance', function ($app) {
            return new Finance();
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/finance.php' => config_path('finance.php'),
            ], 'finance-config');
        }
    }
}