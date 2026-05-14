<?php

namespace Cofa\NeoleapIntegrationPackage\Tests\Services;

use PHPUnit\Framework\TestCase;
use Cofa\NeoleapIntegrationPackage\DTOs\CardOnFileDeletionData;
use Cofa\NeoleapIntegrationPackage\Services\Checkout;

class CardOnFileDeletionTest extends TestCase
{
    // Test 1: DTO holds required fields
    public function test_card_on_file_deletion_data_holds_required_fields()
    {
        $dto = new CardOnFileDeletionData(
            cardOnFileToken: '202613103841966',
        );

        $this->assertEquals('202613103841966', $dto->cardOnFileToken);
        $this->assertEquals('deletion', $dto->cardOnFileAction);
    }

    // Test 2: DTO toTrandataArray returns all required fields
    public function test_card_on_file_deletion_data_returns_trandata_array()
    {
        $dto = new CardOnFileDeletionData(
            cardOnFileToken: '202613103841966',
        );

        $trandata = $dto->toTrandataArray('test_id', 'test_pw');

        $this->assertEquals('test_pw', $trandata['password']);
        $this->assertEquals('test_id', $trandata['id']);
        $this->assertEquals('202613103841966', $trandata['cardOnFileToken']);
        $this->assertEquals('deletion', $trandata['cardOnFileAction']);
    }

    // Test 3: Checkout has a deleteCard method
    public function test_checkout_has_delete_card_method()
    {
        $this->assertTrue(method_exists(Checkout::class, 'deleteCard'));
    }

    // Test 4: deleteCard returns array with status key (simulated)
    public function test_delete_card_returns_array_with_status()
    {
        $checkoutMock = $this->getMockBuilder(Checkout::class)
            ->onlyMethods(['postToNeoleap'])
            ->getMock();

        $checkoutMock->expects($this->once())
            ->method('postToNeoleap')
            ->willReturn([['status' => '1', 'result' => 'DELETED']]);

        $dto = new CardOnFileDeletionData(
            cardOnFileToken: '202613103841966',
        );

        $result = $checkoutMock->deleteCard($dto, customerIp: '203.0.113.1');

        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals('1', $result[0]['status']);
    }

    // Test 5: live call to Neoleap to delete saved card
    public function test_delete_card_live_call()
    {
        $config = file_exists(__DIR__ . '/../../config/neoleap.php') ? include(__DIR__ . '/../../config/neoleap.php') : [];

        if (empty($config['tranportal_id'])) {
            $this->markTestSkipped('Real credentials not provided in config.');
        }

        $checkout = new Checkout();
        $dto = new CardOnFileDeletionData(
            cardOnFileToken: '202613103841966',
        );

        $result = $checkout->deleteCard($dto, customerIp: '203.0.113.1');

        $this->assertIsArray($result);

        if (isset($result['status']) && $result['status'] === 'error') {
            $this->markTestSkipped('Neoleap server unreachable or returned an error: ' . ($result['message'] ?? 'unknown'));
        }

        $this->assertArrayHasKey(0, $result);
        $this->assertArrayHasKey('status', $result[0]);
    }
}
