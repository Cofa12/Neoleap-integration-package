<?php

namespace Cofa\NeoleapIntegrationPackage\Tests\Services;

use PHPUnit\Framework\TestCase;
use Cofa\NeoleapIntegrationPackage\DTOs\CardOnFilePaymentData;
use Cofa\NeoleapIntegrationPackage\DTOs\CardOnFileRegistrationData;
use Cofa\NeoleapIntegrationPackage\DTOs\TranDataWrapper;
use Cofa\NeoleapIntegrationPackage\Services\Checkout;

class CardOnFileRegisterThenPayTest extends TestCase
{
    // Full flow: register card → decrypt token → pay with saved card
    public function test_register_card_then_pay_with_token()
    {
        $config = file_exists(__DIR__ . '/../../config/neoleap.php') ? include(__DIR__ . '/../../config/neoleap.php') : [];

        if (empty($config['tranportal_id'])) {
            $this->markTestSkipped('Real credentials not provided in config.');
        }

        $checkout = new Checkout();
        $wrapper  = new TranDataWrapper(amt: 0);

        // Step 1: Register card
        $registerDto = new CardOnFileRegistrationData(
            cardNo: '4012001037141112',
            expMonth: '12',
            expYear: '2027',
        );

        $registerResponse = $checkout->registerCard($registerDto, customerIp: '203.0.113.1');

        $this->assertIsArray($registerResponse);

        if (isset($registerResponse['status']) && $registerResponse['status'] === 'error') {
            $this->markTestSkipped('Neoleap server unreachable or returned an error: ' . ($registerResponse['message'] ?? 'unknown'));
        }

        $this->assertArrayHasKey(0, $registerResponse);
        $this->assertEquals('1', $registerResponse[0]['status'], 'Card registration failed: ' . ($registerResponse[0]['errorText'] ?? 'unknown'));
        $this->assertArrayHasKey('trandata', $registerResponse[0]);

        // Step 2: Decrypt registration response to get token + masked card
        $decrypted = $wrapper->decryptResponse($registerResponse[0]['trandata']);
        $parsed    = json_decode($decrypted, true);

        $this->assertNotNull($parsed, 'Failed to parse decrypted registration response');
        $this->assertArrayHasKey('cardOnFileToken', $parsed[0]);
        $this->assertArrayHasKey('maskedCardNo', $parsed[0]);

        $cardOnFileToken = $parsed[0]['cardOnFileToken'];
        $maskedCardNo    = $parsed[0]['maskedCardNo'];

        $this->assertNotEmpty($cardOnFileToken);
        $this->assertNotEmpty($maskedCardNo);

        // Step 3: Pay using the token from registration
        $payDto = new CardOnFilePaymentData(
            amt: 1,
            cardOnFileToken: $cardOnFileToken,
            maskedCardNo: $maskedCardNo,
            cvv2: '212',
            member: 'Test User',
            cardType: 'C',
        );

        $payResponse = $checkout->payWithSavedCard($payDto, customerIp: '203.0.113.1');

        $this->assertIsArray($payResponse);
        $this->assertArrayHasKey(0, $payResponse);
        $this->assertArrayHasKey('status', $payResponse[0]);

        echo PHP_EOL . '=== Register → Pay Flow ===' . PHP_EOL;
        echo 'Card On File Token : ' . $cardOnFileToken . PHP_EOL;
        echo 'Masked Card No     : ' . $maskedCardNo . PHP_EOL;
        echo 'Payment status     : ' . $payResponse[0]['status'] . PHP_EOL;

        if (isset($payResponse[0]['trandata'])) {
            $payDecrypted = $wrapper->decryptResponse($payResponse[0]['trandata']);
            $payParsed    = json_decode($payDecrypted, true);
            echo 'Payment response   : ' . $payDecrypted . PHP_EOL;
            $this->assertNotNull($payParsed);
        }

        if (isset($payResponse[0]['errorText'])) {
            echo 'Error              : ' . $payResponse[0]['errorText'] . PHP_EOL;
        }
    }
}
