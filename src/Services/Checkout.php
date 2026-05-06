<?php
namespace Cofa\NeoleapIntegrationPackage\Services;

use Cofa\NeoleapIntegrationPackage\DTOs\TranDataWrapper;

class Checkout
{
    public function checkout(?TranDataWrapper $dataWrapper = null): string
    {
        if (!$dataWrapper) {
            $dataWrapper = new TranDataWrapper(
                amt: 1,
                action: 1,
                currencyCode: 682
            );
        }

        $encryptedData = $dataWrapper->returnEncryptedTrandata();

        if (function_exists('config')) {
            $config = config('neoleap', []);
        } else {
            $config = file_exists(__DIR__ . '/../../config/neoleap.php') ? include(__DIR__ . '/../../config/neoleap.php') : [];
        }
        $merchantId = $config['merchant_id'] ?? $dataWrapper->id;

        return $this->postToNeoleap(
            $encryptedData,
            $merchantId,
            $dataWrapper->responseURL,
            $dataWrapper->errorURL
        );
    }

    public function postToNeoleap(string $data, string $id, ?string $responseURL, ?string $errorURL): string
    {
        $url = $this->returnNeoleapURL();

        $ch = curl_init($url);

        $postData = json_encode([
            'tranportalId' => $id,
            'trandata' => $data,
            'responseURL' => $responseURL,
            'errorURL' => $errorURL
        ]);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Accept: application/json"
        ));
        
        // Debugging
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');

        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            return "CURL Error: " . $error_msg;
        }
        
        curl_close($ch);

        return (string) $response;   
    }

    public function returnNeoleapURL(): string
    {
        if (function_exists('config')) {
            $config = config('neoleap', []);
        } else {
            $config = file_exists(__DIR__ . '/../../config/neoleap.php') ? include(__DIR__ . '/../../config/neoleap.php') : [];
        }

        return $config['neoleap_url'] ?? "";
    }
}