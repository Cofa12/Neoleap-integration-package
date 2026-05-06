<?php

namespace Cofa\NeoleapIntegrationPackage\Tests\DTOs;

use PHPUnit\Framework\TestCase;
use Cofa\NeoleapIntegrationPackage\DTOs\TranDataWrapper;

class TranDataWrapperTest extends TestCase
{
    public function test_it_can_be_instantiated()
    {
        $wrapper = new TranDataWrapper(
            amt: 100,
            action: 1,
            currencyCode: 682,
            id: 12345,
            password: 'test_password'
        );

        $this->assertInstanceOf(TranDataWrapper::class, $wrapper);
        $this->assertEquals(100, $wrapper->amt);
        $this->assertEquals('test_password', $wrapper->password);
    }

    public function test_it_loads_config_defaults()
    {
        $wrapper = new TranDataWrapper(
            amt: 100,
            action: 1,
            currencyCode: 682,
            id: 12345
        );

        // Check if values from config/neoleap.php are loaded
        // This assumes config/neoleap.php exists and has a 'password' key
        $this->assertNotEmpty($wrapper->password);
    }

    public function test_it_returns_transaction_string()
    {
        $wrapper = new TranDataWrapper(
            amt: 100,
            action: 1,
            currencyCode: 682,
            id: 12345,
            password: 'test_password'
        );

        $json = $wrapper->returnTransactionString();
        $data = json_decode($json, true);

        $this->assertEquals(100, $data['amt']);
        $this->assertEquals('test_password', $data['password']);
        $this->assertEquals(12345, $data['id']);
    }

    public function test_it_returns_encrypted_data()
    {
        $wrapper = new TranDataWrapper(
            amt: 100,
            action: 1,
            currencyCode: 682,
            id: 12345
        );

        $encrypted = $wrapper->returnEncryptedTrandata();
        $this->assertIsString($encrypted);
        $this->assertNotEmpty($encrypted);
    }
}
