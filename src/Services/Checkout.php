<?php
namespace Cofa\NeoleapIntegrationPackage\Services;

use Cofa\NeoleapIntegrationPackage\DTOs\CardOnFileDeletionData;
use Cofa\NeoleapIntegrationPackage\DTOs\CardOnFilePaymentData;
use Cofa\NeoleapIntegrationPackage\DTOs\CardOnFileRegistrationData;
use Cofa\NeoleapIntegrationPackage\DTOs\TranDataWrapper;
use Cofa\NeoleapIntegrationPackage\DTOs\WalletPaymentData;

class Checkout
{
    public function checkout(?TranDataWrapper $dataWrapper = null, string $customerIp = ''): array
    {
        if (!$dataWrapper) {
            $dataWrapper = new TranDataWrapper(
                amt: 1,
                action: 1,
                currencyCode: 682
            );
        }

        $encryptedData = $dataWrapper->returnEncryptedTrandata();

        $config     = $this->loadConfig();
        $merchantId = !empty($config['merchant_id']) ? $config['merchant_id'] : $dataWrapper->id;

        return $this->postToNeoleap(
            $encryptedData,
            $merchantId,
            $dataWrapper->responseURL,
            $dataWrapper->errorURL,
            $customerIp
        );
    }

    /**
     * Posts encrypted transaction data to Neoleap.
     *
     * @return array  ['status' => '1', 'result' => 'paymentId:url'] on success
     *                ['status' => 'error', 'message' => '...']      on failure
     */
    public function postToNeoleap(string $data, string $id, ?string $responseURL, ?string $errorURL, string $customerIp = '', ?string $url = null): array
    {
        $url = $url ?? $this->returnNeoleapURL();

        // Doc requires array-wrapped body: [{...}]
        $postBody = json_encode([[
            'id'          => $id,
            'trandata'    => $data,
            'responseURL' => $responseURL ?? '',
            'errorURL'    => $errorURL    ?? '',
        ]]);

        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
        ];

        if ($customerIp !== '') {
            $headers[] = 'X-FORWARDED-FOR: ' . $customerIp;
        }

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $postBody,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER     => $headers,
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return ['status' => 'error', 'message' => 'CURL Error: ' . $error];
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $decoded = json_decode($response, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            return $decoded;
        }

        // Non-JSON response — return raw for debugging
        return [
            'status'   => 'error',
            'message'  => 'Non-JSON response received',
            'http_code' => $httpCode,
            'raw'      => $response,
        ];
    }

    public function payWithSavedCard(CardOnFilePaymentData $dto, string $customerIp = ''): array
    {
        $config      = $this->loadConfig();
        $id          = ($config['tranportal_id'] ?? '');
        $password    = $config['password'] ?? '';
        $responseURL = $config['response_url'] ?? '';
        $errorURL    = $config['error_url'] ?? '';
        $trackId     = (string) time();

        $trandataArray               = $dto->toTrandataArray($id, $password, $trackId);
        $trandataArray['responseURL'] = $responseURL;
        $trandataArray['errorURL']    = $errorURL;

        $plaintext = json_encode([$trandataArray]);
        $trandata  = $this->encryptTrandata($plaintext, $config);

        return $this->postToNeoleap(
            $trandata,
            $id,
            $responseURL,
            $errorURL,
            $customerIp,
            $config['neoleap_merchant_url'] ?? ''
        );
    }

    public function payWithWallet(WalletPaymentData $dto, string $customerIp = ''): array
    {
        $config      = $this->loadConfig();
        $id          = ($config['tranportal_id'] ?? '');
        $password    = $config['password'] ?? '';
        $responseURL = $config['response_url'] ?? '';
        $errorURL    = $config['error_url'] ?? '';
        $trackId     = (string) time();

        $plaintext = json_encode([$dto->toTrandataArray($id, $password, $trackId, $responseURL, $errorURL)]);
        $trandata  = $this->encryptTrandata($plaintext, $config);

        return $this->postToNeoleap(
            $trandata,
            $id,
            $responseURL,
            $errorURL,
            $customerIp
        );
    }

    public function deleteCard(CardOnFileDeletionData $dto, string $customerIp = ''): array
    {
        $config   = $this->loadConfig();
        $id       =  ($config['tranportal_id'] ?? '');
        $password = $config['password'] ?? '';

        $plaintext = json_encode([$dto->toTrandataArray($id, $password)]);
        $trandata  = $this->encryptTrandata($plaintext, $config);

        return $this->postToNeoleap(
            $trandata,
            $id,
            null,
            null,
            $customerIp,
            $config['neoleap_merchant_url'] ?? ''
        );
    }

    public function registerCard(CardOnFileRegistrationData $dto, string $customerIp = ''): array
    {
        $config   = $this->loadConfig();
        $id       =  ($config['tranportal_id'] ?? '');
        $password = $config['password'] ?? '';

        $plaintext = json_encode([$dto->toTrandataArray($id, $password)]);
        $trandata  = $this->encryptTrandata($plaintext, $config);

        return $this->postToNeoleap(
            $trandata,
            $id,
            null,
            null,
            $customerIp,
            $config['neoleap_merchant_url'] ?? ''
        );
    }

    public function parseCallbackResponse(string $trandata): array
    {
        $config = $this->loadConfig();
        $key    = $config['encryption_key'] ?? '';
        $iv     = $config['encryption_iv']  ?? '';

        $decrypted = openssl_decrypt(
            base64_encode(hex2bin($trandata)),
            'aes-256-cbc',
            $key,
            OPENSSL_ZERO_PADDING,
            $iv
        );

        $pad      = ord($decrypted[strlen($decrypted) - 1]);
        $json     = urldecode(substr($decrypted, 0, strlen($decrypted) - $pad));
        $parsed   = json_decode($json, true);

        if (!is_array($parsed)) {
            return ['success' => false, 'raw' => $json];
        }

        $data    = $parsed[0] ?? $parsed;
        $success = strtoupper($data['result'] ?? '') === 'CAPTURED';

        return [
            'success'   => $success,
            'result'    => $data['result']    ?? null,
            'auth'      => $data['auth']      ?? null,
            'ref'       => $data['ref']       ?? null,
            'trackId'   => $data['trackId']   ?? null,
            'paymentId' => $data['paymentId'] ?? null,
            'amt'       => $data['amt']       ?? null,
            'raw'       => $data,
        ];
    }

    public function returnNeoleapURL(): string
    {
        $config = $this->loadConfig();
        return $config['neoleap_url'] ?? '';
    }

    private function encryptTrandata(string $plaintext, array $config): string
    {
        $key = $config['encryption_key'] ?? '';
        $iv  = $config['encryption_iv']  ?? '';
        $pad = 16 - (strlen($plaintext) % 16);
        $padded = $plaintext . str_repeat(chr($pad), $pad);
        $encrypted = openssl_encrypt($padded, 'aes-256-cbc', $key, OPENSSL_ZERO_PADDING, $iv);
        return strtoupper(bin2hex(base64_decode($encrypted)));
    }

    private function loadConfig(): array
    {
        if (function_exists('config')) {
            return config('neoleap', []);
        }
        $path = __DIR__ . '/../../config/neoleap.php';
        return file_exists($path) ? include($path) : [];
    }
}