<?php

namespace Cofa\NeoleapIntegrationPackage\Tests\Services;

use PHPUnit\Framework\TestCase;
use Cofa\NeoleapIntegrationPackage\DTOs\FasterCheckoutData;
use Cofa\NeoleapIntegrationPackage\Services\Checkout;

class FasterCheckoutTest extends TestCase
{
    public function test_faster_checkout_data_holds_required_fields()
    {
        $dto = new FasterCheckoutData(
            amt: 100,
            custid: '201936122890007',
        );

        $this->assertEquals(100, $dto->amt);
        $this->assertEquals('201936122890007', $dto->custid);
        $this->assertEquals(1, $dto->action);
        $this->assertEquals(682, $dto->currencyCode);
        $this->assertEquals('ar', $dto->langid);
        $this->assertNull($dto->custCardHolderName);
        $this->assertNull($dto->custMobileNumber);
        $this->assertNull($dto->custEmailId);
    }

    public function test_faster_checkout_data_returns_trandata_array()
    {
        $dto = new FasterCheckoutData(
            amt: 100,
            custid: '201936122890007',
            trackId: 'track123',
        );

        $trandata = $dto->toTrandataArray('test_id', 'test_pw', 'https://r.url', 'https://e.url');

        $this->assertEquals('100.00', $trandata['amt']);
        $this->assertEquals('1', $trandata['action']);
        $this->assertEquals('test_pw', $trandata['password']);
        $this->assertEquals('test_id', $trandata['id']);
        $this->assertEquals('682', $trandata['currencyCode']);
        $this->assertEquals('track123', $trandata['trackId']);
        $this->assertEquals('201936122890007', $trandata['custid']);
        $this->assertEquals('https://r.url', $trandata['responseURL']);
        $this->assertEquals('https://e.url', $trandata['errorURL']);
        $this->assertArrayNotHasKey('cust_cardHolderName', $trandata);
        $this->assertArrayNotHasKey('cust_mobile_number', $trandata);
        $this->assertArrayNotHasKey('cust_emailId', $trandata);
    }

    public function test_faster_checkout_data_includes_optional_customer_fields()
    {
        $dto = new FasterCheckoutData(
            amt: 50,
            custid: '201936122890007',
            custCardHolderName: 'John Doe',
            custMobileNumber: '512345678',
            custEmailId: 'john@example.com',
        );

        $trandata = $dto->toTrandataArray('id', 'pw', 'https://r.url', 'https://e.url');

        $this->assertEquals('John Doe', $trandata['cust_cardHolderName']);
        $this->assertEquals('512345678', $trandata['cust_mobile_number']);
        $this->assertEquals('john@example.com', $trandata['cust_emailId']);
    }

    public function test_faster_checkout_data_rejects_empty_custid()
    {
        $this->expectException(\InvalidArgumentException::class);

        new FasterCheckoutData(
            amt: 100,
            custid: '',
        );
    }

    public function test_checkout_faster_returns_array_with_status()
    {
        $checkoutMock = $this->getMockBuilder(Checkout::class)
            ->onlyMethods(['postToNeoleap'])
            ->getMock();

        $checkoutMock->expects($this->once())
            ->method('postToNeoleap')
            ->willReturn([['status' => '1', 'result' => 'token:https://securepayments.neoleap.com.sa/pg/payment/pay.htm']]);

        $dto = new FasterCheckoutData(
            amt: 100,
            custid: '201936122890007',
        );

        $result = $checkoutMock->checkoutFaster($dto, customerIp: '203.0.113.1');

        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals('1', $result[0]['status']);
    }

    public function test_checkout_faster_live_call()
    {
        $config = file_exists(__DIR__ . '/../../config/neoleap.php') ? include(__DIR__ . '/../../config/neoleap.php') : [];

        if (empty($config['tranportal_id'])) {
            $this->markTestSkipped('Real credentials not provided in config.');
        }

        $checkout = new Checkout();
        $dto = new FasterCheckoutData(
            amt: 1,
            custid: '201936122890007',
        );

        $result = $checkout->checkoutFaster($dto, customerIp: '203.0.113.1');

        $this->assertIsArray($result);

        if (isset($result['status']) && $result['status'] === 'error') {
            $this->markTestSkipped('Neoleap server unreachable: ' . ($result['message'] ?? 'unknown'));
        }

        $this->assertArrayHasKey(0, $result);
        $this->assertArrayHasKey('status', $result[0]);

        echo PHP_EOL . '=== Faster Checkout Response ===' . PHP_EOL;
        echo 'Status: ' . $result[0]['status'] . PHP_EOL;
        if (isset($result[0]['result'])) {
            echo 'Result: ' . $result[0]['result'] . PHP_EOL;
        }
        if (isset($result[0]['errorText'])) {
            echo 'Error: ' . $result[0]['errorText'] . PHP_EOL;
        }
    }
}
