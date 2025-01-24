<?php

namespace Truncgil\Finance\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getRates()
 * @method static array|null getCurrency(string $code = null)
 * @method static array|null getGold(string $code = null)
 * @method static array|null getCryptoCurrency(string $code = null)
 * @method static array|null get(string $nameOrCode)
 * @method static array refreshData()
 * 
 * @see \Truncgil\Finance\Finance
 */
class Finance extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'finance';
    }
}
