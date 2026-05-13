<?php

namespace Cofa\NeoleapIntegrationPackage\Tests\Services;

use PHPUnit\Framework\TestCase;
use Cofa\NeoleapIntegrationPackage\DTOs\CardOnFilePaymentData;
use Cofa\NeoleapIntegrationPackage\Services\Checkout;

class CardOnFilePaymentTest extends TestCase
{
    // Test 1: DTO holds all required fields
    public function test_card_on_file_payment_data_holds_required_fields()
    {
        $dto = new CardOnFilePaymentData(
            amt: 100,
            cardOnFileToken: '202613103841966',
            maskedCardNo: '401200******1112',
            cvv2: '212',
            member: 'John Doe',
            cardType: 'C',
            expMonth: '12',
            expYear: '2027',
        );

        $this->assertEquals(100, $dto->amt);
        $this->assertEquals('202613103841966', $dto->cardOnFileToken);
        $this->assertEquals('401200******1112', $dto->maskedCardNo);
        $this->assertEquals('212', $dto->cvv2);
        $this->assertEquals('John Doe', $dto->member);
        $this->assertEquals('C', $dto->cardType);
        $this->assertEquals('12', $dto->expMonth);
        $this->assertEquals('2027', $dto->expYear);
        $this->assertEquals('transaction', $dto->cardOnFileAction);
        $this->assertEquals(1, $dto->action);
        $this->assertEquals(682, $dto->currencyCode);
    }

    // Test 2: DTO toTrandataArray returns all required fields for the gateway
    public function test_card_on_file_payment_data_returns_trandata_array()
    {
        $dto = new CardOnFilePaymentData(
            amt: 100,
            cardOnFileToken: '202613103841966',
            maskedCardNo: '401200******1112',
            cvv2: '212',
            member: 'John Doe',
            cardType: 'C',
            expMonth: '12',
            expYear: '2027',
            trackId: 'track123',
        );

        $trandata = $dto->toTrandataArray('test_id', 'test_pw');

        $this->assertEquals('100.00', $trandata['amt']);
        $this->assertEquals('1', $trandata['action']);
        $this->assertEquals('test_pw', $trandata['password']);
        $this->assertEquals('test_id', $trandata['id']);
        $this->assertEquals('682', $trandata['currencyCode']);
        $this->assertEquals('track123', $trandata['trackId']);
        $this->assertEquals('212', $trandata['cvv2']);
        $this->assertEquals('John Doe', $trandata['member']);
        $this->assertEquals('C', $trandata['cardType']);
        $this->assertEquals('12', $trandata['expMonth']);
        $this->assertEquals('2027', $trandata['expYear']);
        $this->assertEquals('transaction', $trandata['cardOnFileAction']);
        $this->assertEquals('202613103841966', $trandata['cardOnFileToken']);
        $this->assertEquals('401200******1112', $trandata['maskedCardNo']);
    }

    // Test 3: Checkout has a payWithSavedCard method
    public function test_checkout_has_pay_with_saved_card_method()
    {
        $this->assertTrue(method_exists(Checkout::class, 'payWithSavedCard'));
    }

    // Test 4: payWithSavedCard returns array with status key (simulated)
    public function test_pay_with_saved_card_returns_array_with_status()
    {
        $checkoutMock = $this->getMockBuilder(Checkout::class)
            ->onlyMethods(['postToNeoleap'])
            ->getMock();

        $checkoutMock->expects($this->once())
            ->method('postToNeoleap')
            ->willReturn([['status' => '1', 'trandata' => 'ENCRYPTEDRESPONSE']]);

        $dto = new CardOnFilePaymentData(
            amt: 100,
            cardOnFileToken: '202613103841966',
            maskedCardNo: '401200******1112',
            cvv2: '212',
            member: 'John Doe',
            cardType: 'C',
            expMonth: '12',
            expYear: '2027',
        );

        $result = $checkoutMock->payWithSavedCard($dto, customerIp: '203.0.113.1');

        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals('1', $result[0]['status']);
    }

    // Test 5: live call to Neoleap with saved card token
    public function test_pay_with_saved_card_live_call()
    {
        $config = file_exists(__DIR__ . '/../../config/neoleap.php') ? include(__DIR__ . '/../../config/neoleap.php') : [];

        if (empty($config['tranportal_id'])) {
            $this->markTestSkipped('Real credentials not provided in config.');
        }

        $checkout = new Checkout();
        $dto = new CardOnFilePaymentData(
            amt: 1,
            cardOnFileToken: '202613103841966',
            maskedCardNo: '401200******1112',
            cvv2: '212',
            member: 'Test User',
            cardType: 'C',
            expMonth: '12',
            expYear: '2027',
        );

        $result = $checkout->payWithSavedCard($dto, customerIp: '203.0.113.1');

        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertArrayHasKey('status', $result[0]);
    }
}
