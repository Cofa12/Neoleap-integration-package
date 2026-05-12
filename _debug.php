<?php
require 'vendor/autoload.php';

$checkout = new Cofa\NeoleapIntegrationPackage\Services\Checkout();

$dto = new Cofa\NeoleapIntegrationPackage\DTOs\CardOnFileRegistrationData(
    cardNo: '4012001037141112',
    expMonth: '12',
    expYear: '2027',
);

$response = $checkout->registerCard($dto, customerIp: '203.0.113.1');

echo '=== Raw response ===' . PHP_EOL;
print_r($response);

if (isset($response[0]['status']) && $response[0]['status'] === '1') {
    $wrapper   = new Cofa\NeoleapIntegrationPackage\DTOs\TranDataWrapper(amt: 0);
    $decrypted = $wrapper->decryptResponse($response[0]['trandata']);
    $parsed    = json_decode($decrypted, true);

    echo PHP_EOL . '=== SUCCESS ===' . PHP_EOL;
    echo 'Card On File Token : ' . $parsed[0]['cardOnFileToken'] . PHP_EOL;
    echo 'Masked Card No     : ' . $parsed[0]['maskedCardNo'] . PHP_EOL;
} else {
    echo PHP_EOL . 'Error: ' . ($response[0]['errorText'] ?? 'Unknown') . PHP_EOL;
}
