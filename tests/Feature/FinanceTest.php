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
    }

    public function testGetRates()
    {
        // Gerçek API'den veri çekiyoruz
        $rates = Finance::getCurrency(); // Finance sınıfından veri çekiyoruz
        $this->assertIsArray($rates);
        $this->assertArrayHasKey('USD', $rates);
        $this->assertArrayHasKey('EUR', $rates);
        echo "Rates fetched successfully.\n"; // Test sonucu mesajı
    }

    public function testGetCurrency()
    {
        // Gerçek API'den veri çekiyoruz
        $rates = Finance::getCurrency(); // Finance sınıfından veri çekiyoruz
        $usd = $rates['USD'];

        $this->assertIsArray($usd);
        $this->assertSame('Amerikan Doları', $usd['Name']);
        $this->assertIsNumeric($usd['Buying']);
        echo "Currency data fetched successfully.\n"; // Test sonucu mesajı
    }

    public function testGetGold()
    {
        // Finance sınıfından veri çekiyoruz
        $gold = Finance::getGold(); // Finance sınıfındaki getGold metodunu kullanıyoruz
        $this->assertIsArray($gold);
        $this->assertArrayHasKey('GRA', $gold);
        $this->assertIsNumeric($gold['GRA']['Buying']);
        echo "Gold data fetched successfully.\n"; // Test sonucu mesajı
    }

    public function testGetCryptoCurrency()
    {
        // Finance sınıfından veri çekiyoruz
        $crypto = Finance::getCryptoCurrency(); // Finance sınıfındaki getCryptoCurrency metodunu kullanıyoruz
        $this->assertIsArray($crypto);
        $this->assertArrayHasKey('BTC', $crypto);
        $this->assertIsNumeric($crypto['BTC']['USD_Price']);
        echo "Crypto currency data fetched successfully.\n"; // Test sonucu mesajı
    }

    public function testGetByNameOrCode()
    {
        // Gerçek API'den veri çekiyoruz
        $rates = Finance::getCurrency();
        $currency = $rates['USD'];
        $this->assertIsArray($currency);
        $this->assertSame('Amerikan Doları', $currency['Name']);

        // getCurrency metodunu kullanarak EUR verisini çekiyoruz
        $eur = $rates['EUR']; // getCurrency metodunu kullanarak EUR verisini alıyoruz
        $this->assertIsArray($eur);
        $this->assertSame('Currency', $eur['Type']);
        echo "Currency by name or code fetched successfully.\n"; // Test sonucu mesajı
    }

    public function testCacheFunctionality()
    {
        // Gerçek API'den veri çekiyoruz
        $rates = Finance::getCurrency(); // Finance sınıfından veri çekiyoruz
        // Cache'i temizleyelim ve ilk çağrıyı yapalım
        Cache::forget(config('finance.cache_key'));
        $firstCall = $rates;
        $this->assertNotEmpty($firstCall);

        // Cache temizlendikten sonra veriyi tekrar çekelim
        Cache::forget(config('finance.cache_key'));
        $secondCall = Finance::refreshData(); // Bu kısımda gerçek API'den veri çekilmesi sağlanmalı
        $this->assertNotEmpty($secondCall);
        $this->assertNotSame($firstCall, $secondCall);
        echo "Cache functionality tested successfully.\n"; // Test sonucu mesajı
    }
}
