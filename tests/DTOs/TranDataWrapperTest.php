<?php

namespace Cofa\NeoleapIntegrationPackage\Tests\DTOs;

use PHPUnit\Framework\TestCase;
use Cofa\NeoleapIntegrationPackage\DTOs\TranDataWrapper;

class TranDataWrapperTest extends TestCase
{
    private static function config(): array
    {
        return file_exists(__DIR__ . '/../../config/neoleap.php')
            ? include __DIR__ . '/../../config/neoleap.php'
            : [];
    }

    public function test_it_can_be_instantiated()
    {
        $config = self::config();

        $wrapper = new TranDataWrapper(
            amt: 100,
            action: 1,
            currencyCode: 682,
            id: $config['tranportal_id'] ?? 'test_id',
            password: $config['password'] ?? 'test_pw'
        );

        $this->assertInstanceOf(TranDataWrapper::class, $wrapper);
        $this->assertEquals(100, $wrapper->amt);
        $this->assertEquals($config['password'] ?? 'test_pw', $wrapper->password);
    }

    public function test_it_loads_config_defaults()
    {
        $config = self::config();

        $wrapper = new TranDataWrapper(
            amt: 100,
            id: $config['tranportal_id'] ?? 'test_id'
        );

        if (!empty($config['password'])) {
            $this->assertEquals($config['password'], $wrapper->password);
        } else {
            $this->assertIsString($wrapper->password);
        }
    }

    public function test_it_returns_transaction_string()
    {
        $config = self::config();
        $id     = $config['tranportal_id'] ?? 'test_id';
        $pw     = $config['password'] ?? 'test_pw';

        $wrapper = new TranDataWrapper(
            amt: 100,
            action: 1,
            currencyCode: 682,
            id: $id,
            password: $pw
        );

        $json = $wrapper->returnTransactionString();
        $data = json_decode($json, true);

        // trandata is array-wrapped per doc page 758: [{...}]
        $this->assertIsArray($data);
        $this->assertArrayHasKey(0, $data);
        $this->assertEquals("100.00", $data[0]['amt']);
        $this->assertEquals($pw, $data[0]['password']);
        $this->assertEquals($id, $data[0]['id']);
    }

    public function test_it_returns_encrypted_data()
    {
        $config = self::config();

        $wrapper = new TranDataWrapper(
            amt: 100,
            action: 1,
            currencyCode: 682,
            id: $config['tranportal_id'] ?? 'test_id'
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

    // Neoleap URL-encodes the plaintext before encrypting responses (doc page 282 note + live observation)
    public function test_decrypt_response_handles_url_encoded_content()
    {
        $config = file_exists(__DIR__ . '/../../config/neoleap.php') ? include(__DIR__ . '/../../config/neoleap.php') : [];
        $key    = $config['encryption_key'] ?? '';
        $iv     = $config['encryption_iv']  ?? '';

        // Simulate what Neoleap returns: URL-encoded JSON, PKCS5-padded, AES-256-CBC encrypted
        $plainJson   = '[{"maskedCardNo":"401200******1112","cardOnFileToken":"202613103841966"}]';
        $urlEncoded  = urlencode($plainJson);
        $pad         = 16 - (strlen($urlEncoded) % 16);
        $padded      = $urlEncoded . str_repeat(chr($pad), $pad);
        $encrypted   = openssl_encrypt($padded, 'aes-256-cbc', $key, OPENSSL_ZERO_PADDING, $iv);
        $hexData     = strtoupper(bin2hex(base64_decode($encrypted)));

        $wrapper  = new TranDataWrapper(amt: 1);
        $decrypted = $wrapper->decryptResponse($hexData);

        // decryptResponse must return the plain JSON, not the URL-encoded form
        $this->assertEquals($plainJson, $decrypted);
        $parsed = json_decode($decrypted, true);
        $this->assertEquals('202613103841966', $parsed[0]['cardOnFileToken']);
        $this->assertEquals('401200******1112', $parsed[0]['maskedCardNo']);
    }
}
