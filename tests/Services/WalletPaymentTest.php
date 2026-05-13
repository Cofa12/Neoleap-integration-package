<?php

namespace Cofa\NeoleapIntegrationPackage\Tests\Services;

use PHPUnit\Framework\TestCase;
use Cofa\NeoleapIntegrationPackage\DTOs\WalletPaymentData;
use Cofa\NeoleapIntegrationPackage\Services\Checkout;

class WalletPaymentTest extends TestCase
{
    // Test 1: DTO holds required fields correctly
    public function test_wallet_payment_data_holds_required_fields()
    {
        $dto = new WalletPaymentData(
            amt: 100,
            mobileNumber: '512345678',
        );

        $this->assertEquals(100, $dto->amt);
        $this->assertEquals('512345678', $dto->mobileNumber);
        $this->assertEquals(1, $dto->action);
        $this->assertEquals(682, $dto->currencyCode);
    }

    // Test 2: DTO toTrandataArray returns all required fields including mobileNumber
    public function test_wallet_payment_data_returns_trandata_array()
    {
        $dto = new WalletPaymentData(
            amt: 100,
            mobileNumber: '512345678',
            trackId: 'track123',
        );

        $trandata = $dto->toTrandataArray('test_id', 'test_pw', 'https://r.url', 'https://e.url');

        $this->assertEquals('100.00', $trandata['amt']);
        $this->assertEquals('1', $trandata['action']);
        $this->assertEquals('test_pw', $trandata['password']);
        $this->assertEquals('test_id', $trandata['id']);
        $this->assertEquals('682', $trandata['currencyCode']);
        $this->assertEquals('track123', $trandata['trackId']);
        $this->assertEquals('512345678', $trandata['mobileNumber']);
        $this->assertEquals('https://r.url', $trandata['responseURL']);
        $this->assertEquals('https://e.url', $trandata['errorURL']);
    }

    // Test 3: mobileNumber must be exactly 9 digits
    public function test_wallet_payment_data_rejects_invalid_mobile_number()
    {
        $this->expectException(\InvalidArgumentException::class);

        new WalletPaymentData(
            amt: 100,
            mobileNumber: '12345',  // too short
        );
    }

    // Test 4: Checkout has a payWithWallet method
    public function test_checkout_has_pay_with_wallet_method()
    {
        $this->assertTrue(method_exists(Checkout::class, 'payWithWallet'));
    }

    // Test 5: payWithWallet returns array with status key (simulated)
    public function test_pay_with_wallet_returns_array_with_status()
    {
        $checkoutMock = $this->getMockBuilder(Checkout::class)
            ->onlyMethods(['postToNeoleap'])
            ->getMock();

        $checkoutMock->expects($this->once())
            ->method('postToNeoleap')
            ->willReturn([['status' => '1', 'result' => '700212030953264091:https://securepayments.neoleap.com.sa/pg/URPaypage.htm']]);

        $dto = new WalletPaymentData(
            amt: 100,
            mobileNumber: '512345678',
        );

        $result = $checkoutMock->payWithWallet($dto, customerIp: '203.0.113.1');

        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals('1', $result[0]['status']);
        $this->assertStringContainsString('URPaypage', $result[0]['result']);
    }

    // Test 6: live call to Neoleap wallet endpoint
    public function test_pay_with_wallet_live_call()
    {
        $config = file_exists(__DIR__ . '/../../config/neoleap.php') ? include(__DIR__ . '/../../config/neoleap.php') : [];

        if (empty($config['tranportal_id'])) {
            $this->markTestSkipped('Real credentials not provided in config.');
        }

        $checkout = new Checkout();
        $dto = new WalletPaymentData(
            amt: 1,
            mobileNumber: '512345678',
        );

        $result = $checkout->payWithWallet($dto, customerIp: '203.0.113.1');

        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertArrayHasKey('status', $result[0]);

        echo PHP_EOL . '=== Wallet Payment Response ===' . PHP_EOL;
        echo 'Status: ' . $result[0]['status'] . PHP_EOL;
        if (isset($result[0]['result'])) {
            echo 'Result: ' . $result[0]['result'] . PHP_EOL;
        }
        if (isset($result[0]['errorText'])) {
            echo 'Error: ' . $result[0]['errorText'] . PHP_EOL;
        }
    }
}
