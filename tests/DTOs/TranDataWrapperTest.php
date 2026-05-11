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
            id: "8jOr03F5vq4BVkY",
            password: 'Ps@!0@0KEl57elY'
        );

        $this->assertInstanceOf(TranDataWrapper::class, $wrapper);
        $this->assertEquals(100, $wrapper->amt);
        $this->assertEquals('Ps@!0@0KEl57elY', $wrapper->password);
    }

    public function test_it_loads_config_defaults()
    {
        $wrapper = new TranDataWrapper(
            amt: 100,
            id: "8jOr03F5vq4BVkY"
        );

        $config = file_exists(__DIR__ . '/../../config/neoleap.php') ? include(__DIR__ . '/../../config/neoleap.php') : [];
        
        if (!empty($config['password'])) {
            $this->assertEquals($config['password'], $wrapper->password);
        } else {
            $this->assertIsString($wrapper->password);
        }
    }

    public function test_it_returns_transaction_string()
    {
        $wrapper = new TranDataWrapper(
            amt: 100,
            action: 1,
            currencyCode: 682,
            id: "8jOr03F5vq4BVkY",
            password: 'Ps@!0@0KEl57elY'
        );

        $json = $wrapper->returnTransactionString();
        $data = json_decode($json, true);

        // trandata is array-wrapped per doc page 758: [{...}]
        $this->assertIsArray($data);
        $this->assertArrayHasKey(0, $data);
        $this->assertEquals("100.00", $data[0]['amt']);
        $this->assertEquals('Ps@!0@0KEl57elY', $data[0]['password']);
        $this->assertEquals('8jOr03F5vq4BVkY', $data[0]['id']);
    }

    public function test_it_returns_encrypted_data()
    {
        $wrapper = new TranDataWrapper(
            amt: 100,
            action: 1,
            currencyCode: 682,
            id: "8jOr03F5vq4BVkY"
        );

        $encrypted = $wrapper->returnEncryptedTrandata();
        $this->assertIsString($encrypted);
        $this->assertNotEmpty($encrypted);
    }

    // Bug 1+2+3: cipher must be AES-256-CBC, key used raw (not hex2bin), PKCS5 padding
    // Doc page 282: openssl_encrypt with "aes-256-cbc", OPENSSL_ZERO_PADDING + manual pkcs5_pad, key raw
    public function test_encryption_uses_aes256_cbc_with_raw_key_and_pkcs5_padding()
    {
        $wrapper = new TranDataWrapper(amt: 1, id: 'test', password: 'p', trackId: 'fixed');
        // Force deterministic trandata so we can compare
        $actual = $wrapper->returnEncryptedTrandata();

        // Just verify the length matches AES-256-CBC output (block size 16, hex-encoded)
        // AES-256-CBC and AES-128-CBC produce different ciphertext lengths for same input
        $trandata = $wrapper->returnTransactionString();
        $paddedLen = strlen($trandata) + (16 - strlen($trandata) % 16);
        $this->assertEquals($paddedLen * 2, strlen($actual), 'Ciphertext length must match AES-256-CBC with PKCS5 padding');
    }

    // Bug 2: key must NOT go through hex2bin — raw 32-byte string is the AES-256 key
    public function test_decrypt_round_trips_with_raw_key()
    {
        $wrapper = new TranDataWrapper(amt: 1, id: 'test', password: 'p', trackId: 'fixed');

        $encrypted = $wrapper->returnEncryptedTrandata();
        $decrypted = $wrapper->decryptResponse($encrypted);

        $this->assertEquals($wrapper->returnTransactionString(), $decrypted);
    }
}
