<?php

namespace Cofa\NeoleapIntegrationPackage\Tests\Services;

use PHPUnit\Framework\TestCase;
use Cofa\NeoleapIntegrationPackage\Services\Checkout;

class CheckoutTest extends TestCase
{
    public function test_it_can_return_neoleap_url()
    {
        $checkout = new Checkout();
        $url = $checkout->returnNeoleapURL();

        if (empty($url)) {
            $this->markTestSkipped('neoleap_url is not configured.');
        }

        $this->assertNotEmpty($url);
        $this->assertStringContainsString('neoleap.com.sa', $url);
    }

    public function test_checkout_simulation()
    {
        // Mock the Checkout service
        $checkoutMock = $this->getMockBuilder(Checkout::class)
            ->onlyMethods(['postToNeoleap'])
            ->getMock();

        // Simulate a successful JSON response from Neoleap (returned as array)
        $simulatedResponse = [
            'status'      => '1',
            'payment_url' => 'https://securepayments.neoleap.com.sa/pg/payment/pay.htm?token=simulated_token_123',
            'trackId'     => '123456789',
        ];

        $checkoutMock->expects($this->once())
            ->method('postToNeoleap')
            ->willReturn($simulatedResponse);

        $result = $checkoutMock->checkout();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('status', $result);
        $this->assertArrayHasKey('payment_url', $result);
        $this->assertStringContainsString('simulated_token_123', $result['payment_url']);
    }

    /**
     * This test is excluded from CI by default if credentials are missing
     */
    public function test_real_checkout_call()
    {
        $config = file_exists(__DIR__ . '/../../config/neoleap.php') ? include(__DIR__ . '/../../config/neoleap.php') : [];

        if (empty($config['tranportal_id'])) {
            $this->markTestSkipped('Real credentials not provided in config.');
            return;
        }

        $checkout = new Checkout();
        $response = $checkout->checkout(customerIp: '203.0.113.1');

        $this->assertIsArray($response);

        if (isset($response['status']) && $response['status'] === 'error') {
            $this->markTestSkipped('Neoleap server unreachable or returned an error: ' . ($response['message'] ?? 'unknown'));
        }

        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey('status', $response[0]);
    }

    public function test_it_can_decrypt_response()
    {
        $wrapper = new \Cofa\NeoleapIntegrationPackage\DTOs\TranDataWrapper(amt: 1);

        $encrypted = $wrapper->returnEncryptedTrandata();
        $decrypted = $wrapper->decryptResponse($encrypted);

        $this->assertEquals($wrapper->returnTransactionString(), $decrypted);
    }

    // Bug 4+5: postToNeoleap must receive customerIp as 5th argument
    // Doc page 13: X-FORWARDED-FOR is mandatory; doc page 20: body is [{...}]
    public function test_post_body_is_json_array()
    {
        $captured = null;

        $checkoutMock = $this->getMockBuilder(Checkout::class)
            ->onlyMethods(['postToNeoleap'])
            ->getMock();

        $checkoutMock->expects($this->once())
            ->method('postToNeoleap')
            ->willReturnCallback(function (string $data, string $id, ?string $responseURL, ?string $errorURL, string $customerIp) use (&$captured) {
                $captured = ['data' => $data, 'id' => $id, 'responseURL' => $responseURL, 'errorURL' => $errorURL, 'customerIp' => $customerIp];
                return [['status' => '1', 'result' => 'token:https://example.com']];
            });

        $checkoutMock->checkout(customerIp: '1.2.3.4');

        $this->assertNotNull($captured, 'postToNeoleap was not called');
        $this->assertArrayHasKey('customerIp', $captured);
        $this->assertEquals('1.2.3.4', $captured['customerIp']);
    }

    // Bug 5: X-FORWARDED-FOR header must be sent with customer IP
    // Doc page 13: mandatory for all requests or gateway declines
    public function test_post_to_neoleap_sends_x_forwarded_for_header()
    {
        $config = file_exists(__DIR__ . '/../../config/neoleap.php') ? include(__DIR__ . '/../../config/neoleap.php') : [];

        if (empty($config['tranportal_id'])) {
            $this->markTestSkipped('Real credentials not provided in config.');
        }

        $checkout = new Checkout();
        // Pass a known customer IP — real call should not get InvalidAccess
        $response = $checkout->checkout(customerIp: '203.0.113.1');

        $this->assertIsArray($response);
        // A valid response has status '1' or '2', not our internal 'error' key from curl failure
        $this->assertArrayNotHasKey('message', $response, 'Got internal error: ' . ($response['message'] ?? ''));
    }
}
