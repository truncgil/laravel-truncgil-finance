<?php

namespace Truncgil\Finance;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Exception;

class Finance
{
    protected array $data;
    protected array $config;

    public function __construct()
    {
        $this->config = config('finance');
        $this->data = $this->getData();
    }

    protected function getData(): array
    {
        try {
            return Cache::remember($this->config['cache_key'], $this->config['cache_duration'], function () {
                $response = Http::timeout($this->config['timeout'])
                    ->get($this->config['api_url']);

                if (!$response->successful()) {
                    throw new Exception("API isteği başarısız: " . $response->status());
                }
                return $response->json()['Rates'] ?? [];
            });
        } catch (Exception $e) {
            Log::error('Finance API Error: ' . $e->getMessage());
            
            if ($this->config['throw_exceptions']) {
                throw $e;
            }

            return [];
        }
    }

    public function getRates(): array
    {
        return $this->data;
    }

    public function getCurrency(?string $code = null): array|null
    {
        $currencies = array_filter($this->data, function($item) {
            return ($item['Type'] ?? '') === 'Currency';
        });

        if ($code) {
            return $currencies[$code] ?? null;
        }

        return $currencies;
    }

    public function getGold(?string $code = null): array|null
    {
        $golds = array_filter($this->data, function($item) {
            return ($item['Type'] ?? '') === 'Gold';
        });

        if ($code) {
            return $golds[$code] ?? null;
        }

        return $golds;
    }

    public function getCryptoCurrency(?string $code = null): array|null
    {
        $cryptos = array_filter($this->data, function($item) {
            return ($item['Type'] ?? '') === 'CryptoCurrency';
        });

        if ($code) {
            return $cryptos[$code] ?? null;
        }

        return $cryptos;
    }

    public function get(string $nameOrCode): ?array
    {
        foreach ($this->data as $code => $item) {
            if ($code === $nameOrCode || ($item['Name'] ?? '') === $nameOrCode) {
                return $item;
            }
        }
        return null;
    }

    public function refreshData(): array
    {
        Cache::forget($this->config['cache_key']);
        $this->data = $this->getData();
        return $this->data;
    }
}