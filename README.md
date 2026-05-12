# Neoleap Integration Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cofa/neoleap-integration-package.svg?style=flat-square)](https://packagist.org/packages/cofa/neoleap-integration-package)
[![Total Downloads](https://img.shields.io/packagist/dt/cofa/neoleap-integration-package.svg?style=flat-square)](https://packagist.org/packages/cofa/neoleap-integration-package)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/cofa12/Neoleap-integration-package/test.yml?branch=main&label=tests&style=flat-square)](https://github.com/cofa12/Neoleap-integration-package/actions)

A PHP/Laravel package to seamlessly integrate the [Neoleap Payment Gateway](https://securepayments.neoleap.com.sa) into your application.

## Features

- **Hosted Checkout** — redirect customers to the Neoleap-hosted payment page
- **Card on File** — register, charge, and delete saved cards
- **Wallet Payment** — charge via mobile wallet (STC Pay etc.)
- **Callback Parsing** — decrypt and parse Neoleap's encrypted callback response
- **AES-256-CBC Encryption** — built-in PKCS5-padded encryption matching gateway spec
- **Laravel & plain PHP** — works with or without the Laravel framework

---

## Requirements

- PHP 8.1+
- `ext-openssl`
- `ext-curl`

---

## Installation

```bash
composer require cofa/neoleap-integration-package
```

### Laravel

The service provider is auto-discovered. Publish the config file:

```bash
php artisan vendor:publish --tag=neoleap-config
```

---

## Configuration

Create or publish `config/neoleap.php`:

```php
return [
    'password'             => env('NEOLEAP_PASSWORD', ''),
    'tranportal_id'        => env('NEOLEAP_TRANPORTAL_ID', ''),
    'encryption_key'       => env('NEOLEAP_ENCRYPTION_KEY', ''),   // 32-byte raw key
    'encryption_iv'        => env('NEOLEAP_ENCRYPTION_IV', ''),    // 16-byte IV
    'neoleap_url'          => env('NEOLEAP_URL', 'https://securepayments.neoleap.com.sa/pg/payment/hosted.htm'),
    'neoleap_merchant_url' => env('NEOLEAP_MERCHANT_URL', 'https://securepayments.neoleap.com.sa/pg/payment/tranportal.htm'),
    'response_url'         => env('NEOLEAP_RESPONSE_URL', ''),
    'error_url'            => env('NEOLEAP_ERROR_URL', ''),
];
```

Add the corresponding variables to your `.env`:

```env
NEOLEAP_PASSWORD=your_password
NEOLEAP_TRANPORTAL_ID=your_tranportal_id
NEOLEAP_ENCRYPTION_KEY=your_32_byte_key
NEOLEAP_ENCRYPTION_IV=your_16_byte_iv
NEOLEAP_RESPONSE_URL=https://yourapp.com/neoleap/callback/success
NEOLEAP_ERROR_URL=https://yourapp.com/neoleap/callback/error
```

---

## Usage

### 1. Hosted Checkout

Redirect the customer to the Neoleap-hosted payment page.

```php
use Cofa\NeoleapIntegrationPackage\Services\Checkout;
use Cofa\NeoleapIntegrationPackage\DTOs\TranDataWrapper;

$checkout = new Checkout();

$wrapper = new TranDataWrapper(
    amt:     150,                 // amount in SAR (integer)
    action:  1,                   // 1=purchase, 2=auth, 3=refund, 4=void
    trackId: 'order_' . time(),  // optional — defaults to time()
    langid:  'ar',                // 'ar' or 'en'
);

$response = $checkout->checkout($wrapper, customerIp: '203.0.113.1');
// $response[0]['status']      — '1' on success
// $response[0]['result']      — 'paymentId:redirectUrl'

[$paymentId, $redirectUrl] = explode(':', $response[0]['result'], 2);
header('Location: ' . $redirectUrl);
exit;
```

#### TranDataWrapper parameters

| Parameter     | Type      | Default     | Description                              |
|---------------|-----------|-------------|------------------------------------------|
| `amt`         | `int`     | —           | Amount in SAR                            |
| `action`      | `int`     | `1`         | 1=purchase, 2=auth, 3=refund, 4=void     |
| `currencyCode`| `int`     | `682`       | 682 = Saudi Riyal                        |
| `trackId`     | `string`  | `time()`    | Unique order reference                   |
| `responseURL` | `string`  | from config | Success callback URL                     |
| `errorURL`    | `string`  | from config | Error callback URL                       |
| `langid`      | `string`  | `'ar'`      | Payment page language (`ar` / `en`)      |
| `udf1`–`udf5` | `string`  | `''`        | User-defined fields (passed through)     |

> `tranportal_id` and `password` are always loaded from config — no need to pass them.

---

### 2. Card on File — Register

Save a card for future charges without storing card details yourself.

```php
use Cofa\NeoleapIntegrationPackage\Services\Checkout;
use Cofa\NeoleapIntegrationPackage\DTOs\CardOnFileRegistrationData;

$checkout = new Checkout();

$dto = new CardOnFileRegistrationData(
    cardNo:   '4012001037141112',
    expMonth: '05',
    expYear:  '2027',
);

$response = $checkout->registerCard($dto, customerIp: '203.0.113.1');
// $response[0]['maskedCardNo']      — masked PAN e.g. 401200******1112
// $response[0]['cardOnFileToken']   — token to use for future charges
```

#### CardOnFileRegistrationData parameters

| Parameter        | Type     | Required | Description                        |
|------------------|----------|----------|------------------------------------|
| `cardNo`         | `string` | yes      | Full card number                   |
| `expMonth`       | `string` | yes      | Expiry month (2 digits)            |
| `expYear`        | `string` | yes      | Expiry year (4 digits)             |
| `cardOnFileToken`| `string` | no       | Existing token (for re-registration)|

---

### 3. Card on File — Pay with Saved Card

Charge a previously registered card using its token.

```php
use Cofa\NeoleapIntegrationPackage\Services\Checkout;
use Cofa\NeoleapIntegrationPackage\DTOs\CardOnFilePaymentData;

$checkout = new Checkout();

$dto = new CardOnFilePaymentData(
    amt:             150,
    cardOnFileToken: '202613103841966',
    maskedCardNo:    '401200******1112',
    cvv2:            '123',
    member:          'John Doe',
    cardType:        'C',           // 'C' = credit, 'D' = debit
    expMonth:        '05',
    expYear:         '2027',
    trackId:         'order_' . time(),  // optional — defaults to time()
);

$response = $checkout->payWithSavedCard($dto, customerIp: '203.0.113.1');
// $response[0]['status'] — '1' on success
// $response[0]['result'] — result code e.g. 'CAPTURED'
```

#### CardOnFilePaymentData parameters

| Parameter        | Type     | Default | Description                        |
|------------------|----------|---------|------------------------------------|
| `amt`            | `int`    | —       | Amount in SAR                      |
| `cardOnFileToken`| `string` | —       | Token from registration            |
| `maskedCardNo`   | `string` | —       | Masked PAN returned at registration|
| `cvv2`           | `string` | —       | Card CVV2                          |
| `member`         | `string` | —       | Cardholder name                    |
| `cardType`       | `string` | —       | `'C'` credit / `'D'` debit         |
| `expMonth`       | `string` | —       | Expiry month (2 digits)            |
| `expYear`        | `string` | —       | Expiry year (4 digits)             |
| `action`         | `int`    | `1`     | 1=purchase, 2=auth                 |
| `currencyCode`   | `int`    | `682`   | 682 = Saudi Riyal                  |
| `trackId`        | `string` | `time()`| Unique order reference             |
| `udf1`–`udf5`   | `string` | `''`    | User-defined fields                |

---

### 4. Card on File — Delete Saved Card

Remove a previously registered card token from the gateway.

```php
use Cofa\NeoleapIntegrationPackage\Services\Checkout;
use Cofa\NeoleapIntegrationPackage\DTOs\CardOnFileDeletionData;

$checkout = new Checkout();

$dto = new CardOnFileDeletionData(
    cardOnFileToken: '202613103841966',
);

$response = $checkout->deleteCard($dto, customerIp: '203.0.113.1');
// $response[0]['status'] — '1' on success
```

#### CardOnFileDeletionData parameters

| Parameter        | Type     | Required | Description               |
|------------------|----------|----------|---------------------------|
| `cardOnFileToken`| `string` | yes      | Token to delete           |

---

### 5. Wallet Payment

Charge a customer via mobile wallet (e.g. STC Pay).

```php
use Cofa\NeoleapIntegrationPackage\Services\Checkout;
use Cofa\NeoleapIntegrationPackage\DTOs\WalletPaymentData;

$checkout = new Checkout();

$dto = new WalletPaymentData(
    amt:          150,
    mobileNumber: '512345678',          // 9 digits, no country code
    trackId:      'order_' . time(),    // optional — defaults to time()
);

$response = $checkout->payWithWallet($dto, customerIp: '203.0.113.1');
// $response[0]['status'] — '1' on success
// $response[0]['result'] — 'paymentId:redirectUrl'
```

#### WalletPaymentData parameters

| Parameter      | Type     | Default | Description                          |
|----------------|----------|---------|--------------------------------------|
| `amt`          | `int`    | —       | Amount in SAR                        |
| `mobileNumber` | `string` | —       | 9-digit mobile number (no prefix)    |
| `action`       | `int`    | `1`     | 1=purchase                           |
| `currencyCode` | `int`    | `682`   | 682 = Saudi Riyal                    |
| `trackId`      | `string` | `time()`| Unique order reference               |
| `udf1`–`udf5` | `string` | `''`    | User-defined fields                  |

> **Validation:** `mobileNumber` must be exactly 9 digits — an `InvalidArgumentException` is thrown otherwise.

---

### 6. Parsing the Callback Response

Neoleap posts an encrypted `trandata` field to your `responseURL`. Use `parseCallbackResponse` to decrypt and extract the result:

```php
use Cofa\NeoleapIntegrationPackage\Services\Checkout;

$checkout = new Checkout();

$result = $checkout->parseCallbackResponse($_POST['trandata']);

if ($result['success']) {
    // Payment captured
    $trackId   = $result['trackId'];   // your original order reference
    $auth      = $result['auth'];      // authorization code
    $ref       = $result['ref'];       // bank reference
    $paymentId = $result['paymentId'];
    $amt       = $result['amt'];
} else {
    // Payment failed
    $rawResult = $result['result'];    // raw result code from gateway
}
```

#### parseCallbackResponse return keys

| Key         | Description                                  |
|-------------|----------------------------------------------|
| `success`   | `true` if result is `CAPTURED`               |
| `result`    | Raw result string from gateway               |
| `auth`      | Authorization code                           |
| `ref`       | Bank reference number                        |
| `trackId`   | Your original order `trackId`                |
| `paymentId` | Neoleap payment ID                           |
| `amt`       | Charged amount                               |
| `raw`       | Full decoded response array                  |

---

## Testing

```bash
vendor/bin/phpunit
```

Live integration tests (tests that hit the real gateway) are automatically skipped when `tranportal_id` is empty in `config/neoleap.php`.

---

## Security

Never commit real credentials to version control. Always use environment variables and keep `config/neoleap.php` out of your repository (add it to `.gitignore`).

If you discover a security vulnerability, please email `112869567+Cofa12@users.noreply.github.com` instead of opening a public issue.

---

## License

The MIT License (MIT). Please see [LICENSE.md](LICENSE.md) for more information.
