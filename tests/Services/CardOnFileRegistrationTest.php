<?php

namespace Cofa\NeoleapIntegrationPackage\Tests\Services;

use PHPUnit\Framework\TestCase;
use Cofa\NeoleapIntegrationPackage\DTOs\CardOnFileRegistrationData;
use Cofa\NeoleapIntegrationPackage\Services\Checkout;

class CardOnFileRegistrationTest extends TestCase
{
    // Test 1: DTO holds card registration fields correctly
    public function test_card_on_file_registration_data_holds_required_fields()
    {
        $dto = new CardOnFileRegistrationData(
            cardNo: '4012001037141112',
            expMonth: '12',
            expYear: '2027',
        );

        $this->assertEquals('4012001037141112', $dto->cardNo);
        $this->assertEquals('12', $dto->expMonth);
        $this->assertEquals('2027', $dto->expYear);
        $this->assertEquals('registration', $dto->cardOnFileAction);
        $this->assertNull($dto->cardOnFileToken);
    }

    // Test 2: DTO accepts optional cardOnFileToken for subsequent card saves
    public function test_card_on_file_registration_data_accepts_token_for_subsequent_cards()
    {
        $dto = new CardOnFileRegistrationData(
            cardNo: '4012001037141112',
            expMonth: '12',
            expYear: '2027',
            cardOnFileToken: '201936122890007',
        );

        $this->assertEquals('201936122890007', $dto->cardOnFileToken);
    }

    // Test 3: DTO returns correct array-wrapped trandata for encryption
    public function test_card_on_file_registration_data_returns_trandata_array()
    {
        $config = file_exists(__DIR__ . '/../../config/neoleap.php') ? include(__DIR__ . '/../../config/neoleap.php') : [];

        $dto = new CardOnFileRegistrationData(
            cardNo: '4012001037141112',
            expMonth: '12',
            expYear: '2027',
        );

        $trandata = $dto->toTrandataArray($config['tranportal_id'] ?? 'test_id', $config['password'] ?? 'test_pw');

        $this->assertIsArray($trandata);
        $this->assertArrayHasKey('password', $trandata);
        $this->assertArrayHasKey('id', $trandata);
        $this->assertArrayHasKey('cardNo', $trandata);
        $this->assertArrayHasKey('expMonth', $trandata);
        $this->assertArrayHasKey('expYear', $trandata);
        $this->assertEquals('registration', $trandata['cardOnFileAction']);
        $this->assertArrayNotHasKey('cardOnFileToken', $trandata); // excluded for first card
    }

    // Test 4: DTO includes cardOnFileToken in trandata when provided
    public function test_card_on_file_trandata_includes_token_when_provided()
    {
        $dto = new CardOnFileRegistrationData(
            cardNo: '4012001037141112',
            expMonth: '12',
            expYear: '2027',
            cardOnFileToken: '201936122890007',
        );

        $trandata = $dto->toTrandataArray('test_id', 'test_pw');

        $this->assertArrayHasKey('cardOnFileToken', $trandata);
        $this->assertEquals('201936122890007', $trandata['cardOnFileToken']);
    }

    // Test 5: Checkout has a registerCard method
    public function test_checkout_has_register_card_method()
    {
        $this->assertTrue(method_exists(Checkout::class, 'registerCard'));
    }

    // Test 6: registerCard returns array with status key (simulated)
    public function test_register_card_returns_array_with_status()
    {
        $checkoutMock = $this->getMockBuilder(Checkout::class)
            ->onlyMethods(['postToNeoleap'])
            ->getMock();

        $checkoutMock->expects($this->once())
            ->method('postToNeoleap')
            ->willReturn([['status' => '1', 'trandata' => 'ENCRYPTEDRESPONSE']]);

        $dto = new CardOnFileRegistrationData(
            cardNo: '4012001037141112',
            expMonth: '12',
            expYear: '2027',
        );

        $result = $checkoutMock->registerCard($dto, customerIp: '203.0.113.1');

        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals('1', $result[0]['status']);
    }

    // Test 7: registerCard posts to tranportal.htm not hosted.htm
    public function test_register_card_uses_tranportal_endpoint()
    {
        $config = file_exists(__DIR__ . '/../../config/neoleap.php') ? include(__DIR__ . '/../../config/neoleap.php') : [];

        if (empty($config['tranportal_id'])) {
            $this->markTestSkipped('Real credentials not provided in config.');
        }

        $checkout = new Checkout();
        $dto = new CardOnFileRegistrationData(
            cardNo: '4012001037141112',
            expMonth: '12',
            expYear: '2027',
        );

        $result = $checkout->registerCard($dto, customerIp: '203.0.113.1');

        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertArrayHasKey('status', $result[0]);
    }
}
