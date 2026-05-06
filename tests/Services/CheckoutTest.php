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
        
        $this->assertNotEmpty($url);
        $this->assertStringContainsString('neoleap.com.sa', $url);
    }

    public function test_checkout_simulation()
    {
        // Mock the Checkout service
        $checkoutMock = $this->getMockBuilder(Checkout::class)
            ->onlyMethods(['postToNeoleap'])
            ->getMock();

        // Simulate a successful response from Neoleap
        $simulatedResponse = json_encode([[
            'status' => '1',
            'payment_url' => 'https://securepayments.neoleap.com.sa/pg/payment/pay.htm?token=simulated_token_123',
            'trackId' => '123456789'
        ]]);

        $checkoutMock->expects($this->once())
            ->method('postToNeoleap')
            ->willReturn($simulatedResponse);

        $result = $checkoutMock->checkout();

        $this->assertStringContainsString('simulated_token_123', $result);
        $this->assertStringContainsString('payment_url', $result);
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
        $response = $checkout->checkout();
        
        $this->assertNotEmpty($response);
    }

    public function test_it_can_decrypt_response()
    {
        $wrapper = new \Cofa\NeoleapIntegrationPackage\DTOs\TranDataWrapper(amt: 1);
        
        // Simulate an encrypted response
        $encrypted = $wrapper->returnEncryptedTrandata();
        
        // Decrypt it
        $decrypted = $wrapper->decryptResponse($encrypted);
        
        // The result should match the internal transaction string
        $this->assertEquals($wrapper->returnTransactionString(), $decrypted);
    }
}
