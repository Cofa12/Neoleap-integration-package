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

Publish or create a `config/neoleap.php` file in your project:

```php
return [
    'password'       => env('NEOLEAP_PASSWORD', ''),
    'tranportal_id'  => env('NEOLEAP_TRANPORTAL_ID', ''),
    'merchant_id'    => env('NEOLEAP_MERCHANT_ID', ''),
    'encryption_key' => env('NEOLEAP_ENCRYPTION_KEY', ''),
    'encryption_iv'  => env('NEOLEAP_ENCRYPTION_IV', ''),
    'neoleap_url'    => env('NEOLEAP_URL', 'https://securepayments.neoleap.com.sa/pg/payment/hosted.htm'),
    'response_url'   => env('NEOLEAP_RESPONSE_URL', ''),
    'error_url'      => env('NEOLEAP_ERROR_URL', ''),
];
```

## Usage

### Simple Checkout

`checkout()` encrypts the transaction data, posts it to Neoleap, and returns the gateway's JSON response as a PHP **array**.

```php
use Cofa\NeoleapIntegrationPackage\Services\Checkout;
use Cofa\NeoleapIntegrationPackage\DTOs\TranDataWrapper;

$checkout = new Checkout();

$dataWrapper = new TranDataWrapper(
    amt:     100,              // Amount in SAR
    action:  1,                // 1 = Purchase
    trackId: 'order_' . time() // Unique order reference
);

$response = $checkout->checkout($dataWrapper);

// $response is an array, e.g.:
// [
//   'status'      => '1',
//   'payment_url' => 'https://securepayments.neoleap.com.sa/pg/payment/pay.htm?token=...',
// ]

if (!empty($response['payment_url'])) {
    // Redirect the user to the payment page
    header('Location: ' . $response['payment_url']);
    exit;
}
```

### Manual Request Building

Use `TranDataWrapper` directly to build and encrypt the payload:

```php
use Cofa\NeoleapIntegrationPackage\DTOs\TranDataWrapper;

$dataWrapper = new TranDataWrapper(
    amt:         100,
    action:      1,
    currencyCode: 682,
    trackId:     'order_123'
);

// Get encrypted string for the 'trandata' field
$encryptedTrandata = $dataWrapper->returnEncryptedTrandata();
```

### Decrypting the Callback Response

When Neoleap redirects to your `responseURL`, decrypt the returned `trandata`:

```php
use Cofa\NeoleapIntegrationPackage\DTOs\TranDataWrapper;

$dataWrapper    = new TranDataWrapper(amt: 0); // Config loaded automatically
$decryptedJson  = $dataWrapper->decryptResponse($_POST['trandata']);
$responseData   = json_decode($decryptedJson, true);

// $responseData['result'] — transaction result code
// $responseData['trackId'] — your original order reference
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
