# Truncgil Finance Laravel Package

This package allows you to easily use the Truncgil Finance API in your Laravel projects.

## Features

- Easy access to currency rates, gold prices, and cryptocurrency data
- Automatic caching
- Facade support
- Error handling
- Easy configuration

## Installation

Use the following command to add the package to your project:

```bash
composer require truncgil/finance
```

## Configuration

To configure the package, create a `config/finance.php` file and add the following settings:

```php
return [
    'api_url' => 'https://api.truncgil.com/finance',
    'cache_key' => 'finance_data',
    'cache_duration' => 3600, // 1 hour
    'timeout' => 5, // 5 seconds
    'throw_exceptions' => true, // Throw exceptions
];
```

## Usage

### Fetching Data

You can fetch data by using the main class of the package:

```php
use Truncgil\Finance\Finance;

$finance = new Finance();
$data = $finance->getRates();
```

### Fetching a Specific Currency

To fetch a specific currency, you can use the `getCurrency` method:

```php
$currency = $finance->getCurrency('USD'); // Get USD currency data
```

### Fetching Gold Prices

To fetch gold prices, you can use the `getGold` method:

```php
$gold = $finance->getGold(); // Get all gold data
```

### Fetching Cryptocurrency Data

To fetch cryptocurrency data, you can use the `getCryptoCurrency` method:

```php
$crypto = $finance->getCryptoCurrency('BTC'); // Get BTC data
```

### Fetching Data by Code or Name

You can use the `get` method to fetch data by a specific code or name:

```php
$item = $finance->get('Bitcoin'); // Get Bitcoin data
```

### Refreshing Data

To clear the cache and refresh the data, you can use the `refreshData` method:

```php
$updatedData = $finance->refreshData(); // Refresh data
```

## Error Handling

If the API request fails, error handling is done automatically. The `Log` class is used to log errors. If the `throw_exceptions` setting is set to `true`, an exception will be thrown.

## License

This package is licensed under the MIT license.