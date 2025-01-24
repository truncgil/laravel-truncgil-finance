<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Truncgil\Finance\FinanceServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            FinanceServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Burada test için environment ayarlarını yapabilirsin
    }
}
