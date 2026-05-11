<?php
namespace Cofa\NeoleapIntegrationPackage\Services;

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
    public function postToNeoleap(string $data, string $id, ?string $responseURL, ?string $errorURL, string $customerIp = ''): array
    {
        $url = $this->returnNeoleapURL();

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

    public function returnNeoleapURL(): string
    {
        $config = $this->loadConfig();
        return $config['neoleap_url'] ?? '';
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