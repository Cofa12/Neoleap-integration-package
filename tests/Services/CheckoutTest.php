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

    public function test_real_checkout_call()
    {
        $checkout = new Checkout();
        $response = $checkout->checkout();
        echo "\nReal Response from Neoleap: " . substr($response, 0, 500) . "...\n";
        $this->assertNotEmpty($response);
    }

    public function test_it_can_decrypt_response()
    {
        $wrapper = new \Cofa\NeoleapIntegrationPackage\DTOs\TranDataWrapper(amt: 1);
        
        // Simulate an encrypted response
        $encrypted = $wrapper->returnEncryptedTrandata();
        
        // Decrypt it
        $decrypted = $wrapper->decryptResponse($encrypted);
        
        $this->assertEquals($wrapper->returnTransactionString(), $decrypted);
        $this->assertStringContainsString('"amt":1', $decrypted);
    }
}
