<?php

namespace Tests\Feature;

use Tests\TestCase;
use Truncgil\Finance\Facades\Finance;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class FinanceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Mock API yanıtı
        Http::fake([
            'https://finance.truncgil.com/api/today.json' => Http::sequence()
                ->push([
                    'Meta_Data' => [
                        'Minutes_Ago' => -0.09,
                        'Current_Date' => '2025-01-24 14:21:07',
                        'Update_Date' => '2025-01-24 14:21:02'
                    ],
                    'Rates' => [
                        'USD' => [
                            'Type' => 'Currency',
                            'Change' => 0.14,
                            'Name' => 'Amerikan Doları',
                            'Buying' => 35.6834,
                            'Selling' => 35.686
                        ],
                        'EUR' => [
                            'Type' => 'Currency',
                            'Change' => 0.62,
                            'Name' => 'Euro',
                            'Buying' => 37.4436,
                            'Selling' => 37.4501
                        ],
                        // Diğer dövizler...
                    ]
                ])
        ]);
    }

    public function testGetRates()
    {
        $rates = Finance::getRates();
        $this->assertArrayHasKey('USD', $rates);
        $this->assertArrayHasKey('EUR', $rates);
    }

    public function testGetCurrency()
    {
        $usd = Finance::getCurrency('USD');
        $this->assertEquals('Amerikan Doları', $usd['Name']);
        $this->assertEquals(35.6834, $usd['Buying']);
    }

    public function testGetGold()
    {
        $gold = Finance::getGold();
        $this->assertIsArray($gold);
    }

    public function testGetCryptoCurrency()
    {
        $crypto = Finance::getCryptoCurrency();
        $this->assertIsArray($crypto);
    }

    public function testGetByNameOrCode()
    {
        $currency = Finance::get('USD');
        $this->assertEquals('Amerikan Doları', $currency['Name']);

        $currencyByName = Finance::get('Euro');
        $this->assertEquals('EUR', $currencyByName['Type']);
    }

    public function testCacheFunctionality()
    {
        $firstCall = Finance::getRates();
        $this->assertNotEmpty($firstCall);

        // Cache'i temizle ve veriyi yenile
        Cache::forget(config('finance.cache_key'));
        $secondCall = Finance::refreshData();
        $this->assertNotEmpty($secondCall);
        $this->assertNotSame($firstCall, $secondCall);
    }
}
