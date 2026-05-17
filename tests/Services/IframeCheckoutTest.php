<?php

namespace Cofa\NeoleapIntegrationPackage\Tests\Services;

use PHPUnit\Framework\TestCase;
use Cofa\NeoleapIntegrationPackage\DTOs\IframeCheckoutData;
use Cofa\NeoleapIntegrationPackage\Services\Checkout;

class IframeCheckoutTest extends TestCase
{
    public function test_iframe_checkout_data_holds_required_fields()
    {
        $dto = new IframeCheckoutData(amt: 100);

        $this->assertEquals(100, $dto->amt);
        $this->assertEquals(1, $dto->action);
        $this->assertEquals(682, $dto->currencyCode);
        $this->assertEquals('ar', $dto->langid);
        $this->assertNull($dto->custid);
        $this->assertNull($dto->custCardHolderName);
        $this->assertNull($dto->custMobileNumber);
        $this->assertNull($dto->custEmailId);
    }

    public function test_iframe_checkout_data_always_sets_udf3_to_iframe()
    {
        $dto = new IframeCheckoutData(amt: 100);

        $trandata = $dto->toTrandataArray('id', 'pw', 'https://r.url', 'https://e.url');

        $this->assertEquals('iframe', $trandata['udf3']);
    }

    public function test_iframe_checkout_data_includes_custid_when_provided()
    {
        $dto = new IframeCheckoutData(
            amt: 100,
            custid: '201936122890007',
        );

        $trandata = $dto->toTrandataArray('id', 'pw', 'https://r.url', 'https://e.url');

        $this->assertArrayHasKey('custid', $trandata);
        $this->assertEquals('201936122890007', $trandata['custid']);
    }

    public function test_iframe_checkout_data_excludes_customer_fields_when_not_provided()
    {
        $dto = new IframeCheckoutData(amt: 100);

        $trandata = $dto->toTrandataArray('id', 'pw', 'https://r.url', 'https://e.url');

        $this->assertArrayNotHasKey('custid', $trandata);
        $this->assertArrayNotHasKey('cust_cardHolderName', $trandata);
        $this->assertArrayNotHasKey('cust_mobile_number', $trandata);
        $this->assertArrayNotHasKey('cust_emailId', $trandata);
    }

    public function test_checkout_has_checkout_iframe_method()
    {
        $this->assertTrue(method_exists(Checkout::class, 'checkoutIframe'));
    }

    public function test_checkout_iframe_returns_array_with_status()
    {
        $checkoutMock = $this->getMockBuilder(Checkout::class)
            ->onlyMethods(['postToNeoleap'])
            ->getMock();

        $checkoutMock->expects($this->once())
            ->method('postToNeoleap')
            ->willReturn([['status' => '1', 'result' => 'token:https://securepayments.neoleap.com.sa/pg/payment/pay.htm']]);

        $dto = new IframeCheckoutData(amt: 100);

        $result = $checkoutMock->checkoutIframe($dto, customerIp: '203.0.113.1');

        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals('1', $result[0]['status']);
    }

    public function test_checkout_iframe_live_call()
    {
        $config = file_exists(__DIR__ . '/../../config/neoleap.php') ? include(__DIR__ . '/../../config/neoleap.php') : [];

        if (empty($config['tranportal_id'])) {
            $this->markTestSkipped('Real credentials not provided in config.');
        }

        $checkout = new Checkout();
        $dto = new IframeCheckoutData(amt: 1);

        $result = $checkout->checkoutIframe($dto, customerIp: '203.0.113.1');

        $this->assertIsArray($result);

        if (isset($result['status']) && $result['status'] === 'error') {
            $this->markTestSkipped('Neoleap server unreachable: ' . ($result['message'] ?? 'unknown'));
        }

        $this->assertArrayHasKey(0, $result);
        $this->assertArrayHasKey('status', $result[0]);

        echo PHP_EOL . '=== iFrame Checkout Response ===' . PHP_EOL;
        echo 'Status: ' . $result[0]['status'] . PHP_EOL;
        if (isset($result[0]['result'])) {
            echo 'Result: ' . $result[0]['result'] . PHP_EOL;
        }
        if (isset($result[0]['errorText'])) {
            echo 'Error: ' . $result[0]['errorText'] . PHP_EOL;
        }
    }
}
