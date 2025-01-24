# Truncgil Finance Laravel Package

![Light Logo](https://finance.truncgil.com/img/logo-light.svg)
![Dark Logo](http://finance.truncgil.com/img/logo.svg)

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

**Example Output:**
```json
{
    "USD": {
        "Type": "Currency",
        "Change": 0.16,
        "Name": "Amerikan Doları",
        "Buying": 35.6896,
        "Selling": 35.6942
    },
    "EUR": {
        "Type": "Currency",
        "Change": 0.45,
        "Name": "Euro",
        "Buying": 37.3753,
        "Selling": 37.3873
    }
    // ... other currencies
}
```
*Fetches the current exchange rates for all currencies.*

### Fetching a Specific Currency

To fetch a specific currency, you can use the `getCurrency` method:

```php
$currency = $finance->getCurrency('USD'); // Get USD currency data
```

**Example Output:**
```json
{
    "Type": "Currency",
    "Change": 0.16,
    "Name": "Amerikan Doları",
    "Buying": 35.6896,
    "Selling": 35.6942
}
```
*Fetches the data for the specified currency (e.g., USD).*

### Fetching Gold Prices

To fetch gold prices, you can use the `getGold` method:

```php
$gold = $finance->getGold(); // Get all gold data
```

**Example Output:**
```json
{
    "GRA": {
        "Type": "Gold",
        "Name": "GRAMALTIN",
        "Buying": 3192.08,
        "Selling": 3192.59,
        "Change": 1.19
    },
    "GUM": {
        "Type": "Gold",
        "Name": "GUMUS",
        "Buying": 35.44,
        "Selling": 35.49,
        "Change": 1.58
    }
    // ... other gold types
}
```
*Fetches the current prices for gold types.*

### Fetching Cryptocurrency Data

To fetch cryptocurrency data, you can use the `getCryptoCurrency` method:

```php
$crypto = $finance->getCryptoCurrency('BTC'); // Get BTC data
```

**Example Output:**
```json
{
    "Name": "Bitcoin",
    "USD_Price": 105184,
    "TRY_Price": 3747780,
    "Selling": 3747780,
    "Change": 3.17
}
```
*Fetches the current data for the specified cryptocurrency (e.g., Bitcoin).*

### Fetching Data by Code or Name

You can use the `get` method to fetch data by a specific code or name:

```php
$item = $finance->get('Bitcoin'); // Get Bitcoin data
```

**Example Output:**
```json
{
    "Name": "Bitcoin",
    "USD_Price": 105184,
    "TRY_Price": 3747780,
    "Selling": 3747780,
    "Change": 3.17
}
```
*Fetches data for a specific item by its code or name.*

### Refreshing Data

To clear the cache and refresh the data, you can use the `refreshData` method:

```php
$updatedData = $finance->refreshData(); // Refresh data
```

**Example Output:**
```json
{
    "status": "success",
    "message": "Data refreshed successfully."
}
```
*Clears the cache and fetches the latest data from the API.*

## Error Handling

If the API request fails, error handling is done automatically. The `Log` class is used to log errors. If the `throw_exceptions` setting is set to `true`, an exception will be thrown.

## License

This package is licensed under the MIT license.