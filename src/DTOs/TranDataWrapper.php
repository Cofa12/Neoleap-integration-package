<?php
namespace Cofa\NeoleapIntegrationPackage\DTOs;

class TranDataWrapper
{
    public int $amt; // amount of payment
    public int $action = 1; // 1 for purchase, 2 for authorization, 3 for refund, 4 for void
    public int $currencyCode = 682; // 682 for Saudi Riyal
    public string $password; // transaction password
    public string $id; // Tranportal id
    public string $udf1 = '';
    public string $udf2 = '';
    public string $udf3 = '';
    public string $udf4 = '';
    public string $udf5 = '';
    public string $trackId = '123456789';
    public string $langid = 'ar';
    public ?string $responseURL = null;
    public ?string $errorURL = null;
    private $encryptionKey = "";
    private $encryptionIV = "";

    public function __construct(
        int $amt,
        string $id = '',
        int $action = 1,
        int $currencyCode = 682,
        ?string $password = null,
        string $udf1 = '',
        string $udf2 = '',
        string $udf3 = '',
        string $udf4 = '',
        string $udf5 = '',
        ?string $responseURL = null,
        ?string $errorURL = null,
        ?string $trackId = null,
        string $langid = 'ar'
    ) {
        $config = file_exists(__DIR__ . '/../../config/neoleap.php') ? include(__DIR__ . '/../../config/neoleap.php') : [];

        $this->amt = $amt;
        $this->id = $id ?: ($config['tranportal_id'] ?? '');
        $this->action = $action;
        $this->currencyCode = $currencyCode;
        $this->password = $password ?? ($config['password'] ?? '');
        $this->udf1 = $udf1;
        $this->udf2 = $udf2;
        $this->udf3 = $udf3;
        $this->udf4 = $udf4;
        $this->udf5 = $udf5;
        $this->responseURL = $responseURL ?? ($config['response_url'] ?? null);
        $this->errorURL = $errorURL ?? ($config['error_url'] ?? null);
        $this->trackId = $trackId ?: (string) time();
        $this->langid = $langid;
        $this->encryptionKey = $config['encryption_key'] ?? $this->encryptionKey;
        $this->encryptionIV = $config['encryption_iv'] ?? $this->encryptionIV;
    }

    public function returnTransactionString(): string
    {
        return json_encode([
            'amt' => number_format($this->amt, 2, '.', ''),
            'action' => (string) $this->action,
            'password' => $this->password,
            'id' => $this->id,
            'currencyCode' => (string) $this->currencyCode,
            'trackId' => $this->trackId,
            'responseURL' => $this->responseURL,
            'errorURL' => $this->errorURL,
            'udf1' => $this->udf1,
            'udf2' => $this->udf2,
            'udf3' => $this->udf3,
            'udf4' => $this->udf4,
            'udf5' => $this->udf5,
            'langid' => $this->langid
        ]);
    }

    public function returnEncryptedTrandata(): string
    {
        $encrypted = openssl_encrypt(
            $this->returnTransactionString(),
            'AES-128-CBC',
            hex2bin($this->encryptionKey),
            OPENSSL_RAW_DATA,
            $this->encryptionIV
        );

        return strtoupper(bin2hex($encrypted));
    }
    
    public function decryptResponse(string $encryptedHexData): string
    {
        $binaryData = hex2bin($encryptedHexData);
        $decrypted = openssl_decrypt(
            $binaryData,
            'AES-128-CBC',
            hex2bin($this->encryptionKey),
            OPENSSL_RAW_DATA,
            $this->encryptionIV
        );

        return (string) $decrypted;
    }
}