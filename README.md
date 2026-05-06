# Neoleap Integration Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cofa/neoleap-integration-package.svg?style=flat-square)](https://packagist.org/packages/cofa/neoleap-integration-package)
[![Total Downloads](https://img.shields.io/packagist/dt/cofa/neoleap-integration-package.svg?style=flat-square)](https://packagist.org/packages/cofa/neoleap-integration-package)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/cofa12/Neoleap-integration-package/test.yml?branch=main&label=tests&style=flat-square)](https://github.com/cofa12/Neoleap-integration-package/actions)

A PHP/Laravel package to seamlessly integrate the Neoleap Payment Gateway into your application.

## Features

- **Secure Encryption**: Built-in AES-128-CBC encryption for transaction data.
- **DTO Support**: Structured `TranDataWrapper` for easy request management.
- **Laravel Ready**: Easy configuration and integration.
- **Comprehensive Testing**: Includes unit and feature tests.
- **Response Decryption**: Easily decrypt and parse gateway responses.

## Installation

You can install the package via composer:

```bash
composer require cofa/neoleap-integration-package
```

## Configuration

The package uses a configuration file to manage your Neoleap credentials. You can create a `config/neoleap.php` file in your project root (or it will be automatically published if using Laravel).

```php
return [
    'password'       => env('NEOLEAP_PASSWORD', ''),
    'tranportal_id'  => env('NEOLEAP_TRANPORTAL_ID', ''),
    'merchant_id'    => env('NEOLEAP_MERCHANT_ID', ''),
    'encryption_key' => env('NEOLEAP_ENCRYPTION_KEY', 'DCB04EAA4019E367F005909DA87B031A'),
    'encryption_iv'  => env('NEOLEAP_ENCRYPTION_IV', 'PGKEYENCDECIVSPC'),
    'neoleap_url'    => env('NEOLEAP_URL', 'https://securepayments.neoleap.com.sa/pg/payment/hosted.htm'),
    'response_url'   => env('NEOLEAP_RESPONSE_URL', ''),
    'error_url'      => env('NEOLEAP_ERROR_URL', ''),
];
```

## Usage

### Simple Checkout

The `Checkout` service handles the complexity of encrypting data and posting to Neoleap.

```php
use Cofa\NeoleapIntegrationPackage\Services\Checkout;

$checkout = new Checkout();
$response = $checkout->checkout();

// The response will typically contain the HTML form or redirect response from Neoleap
echo $response;
```

### Manual Request Building

You can use the `TranDataWrapper` to manually build and encrypt your request.

```php
use Cofa\NeoleapIntegrationPackage\DTOs\TranDataWrapper;

$dataWrapper = new TranDataWrapper(
    amt: 100,            // Amount
    action: 1,           // 1 for Purchase
    currencyCode: 682,   // SAR
    trackId: 'order_123' // Unique track ID
);

// Get encrypted string for 'trandata' field
$encryptedTrandata = $dataWrapper->returnEncryptedTrandata();
```

### Decrypting Response

When Neoleap redirects back to your `responseURL`, you can decrypt the transaction data:

```php
$dataWrapper = new TranDataWrapper(amt: 0); // Config is loaded automatically
$decryptedJson = $dataWrapper->decryptResponse($_POST['trandata']);
$responseData = json_decode($decryptedJson, true);
```

## Testing

Run the test suite using PHPUnit:

```bash
vendor/bin/phpunit
```

## Security

If you discover any security-related issues, please email 112869567+Cofa12@users.noreply.github.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
