<?php
namespace Cofa\NeoleapIntegrationPackage\Services;

use Cofa\NeoleapIntegrationPackage\DTOs\CardOnFilePaymentData;
use Cofa\NeoleapIntegrationPackage\DTOs\CardOnFileRegistrationData;
use Cofa\NeoleapIntegrationPackage\DTOs\TranDataWrapper;

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
        $id          = !empty($config['merchant_id']) ? $config['merchant_id'] : ($config['tranportal_id'] ?? '');
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
            'https://securepayments.neoleap.com.sa/pg/payment/tranportal.htm'
        );
    }

    public function registerCard(CardOnFileRegistrationData $dto, string $customerIp = ''): array
    {
        $config   = $this->loadConfig();
        $id       = !empty($config['merchant_id']) ? $config['merchant_id'] : ($config['tranportal_id'] ?? '');
        $password = $config['password'] ?? '';

        $plaintext = json_encode([$dto->toTrandataArray($id, $password)]);
        $trandata  = $this->encryptTrandata($plaintext, $config);

        return $this->postToNeoleap(
            $trandata,
            $id,
            null,
            null,
            $customerIp,
            'https://securepayments.neoleap.com.sa/pg/payment/tranportal.htm'
        );
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