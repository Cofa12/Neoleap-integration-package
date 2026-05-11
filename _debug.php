<?php
require 'vendor/autoload.php';

$config = include 'config/neoleap.php';
$iv     = $config['encryption_iv'];
$key    = $config['encryption_key'];

function buildAndPost(string $url, string $key, string $iv, array $config, string $label): void
{
    // Doc page 758: plain trandata is also array-wrapped [{...}]
    $plaintext = json_encode([[
        'amt'         => '1.00',
        'action'      => '1',
        'password'    => $config['password'],
        'id'          => $config['tranportal_id'],
        'currencyCode'=> '682',
        'trackId'     => (string) time(),
        'responseURL' => $config['response_url'],
        'errorURL'    => $config['error_url'],
        'udf1' => '', 'udf2' => '', 'udf3' => '', 'udf4' => '', 'udf5' => '',
        'langid'      => 'ar',
    ]]);

    $pad    = 16 - (strlen($plaintext) % 16);
    $padded = $plaintext . str_repeat(chr($pad), $pad);

    $encrypted = openssl_encrypt($padded, 'aes-256-cbc', $key, OPENSSL_ZERO_PADDING, $iv);
    $trandata  = strtoupper(bin2hex(base64_decode($encrypted)));

    $postBody = json_encode([[
        'id'          => $config['tranportal_id'],
        'trandata'    => $trandata,
        'responseURL' => $config['response_url'],
        'errorURL'    => $config['error_url'],
    ]]);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $postBody,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',
            'Accept: application/json',
            'X-FORWARDED-FOR: 203.0.113.1',
        ],
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo "=== $label ===" . PHP_EOL;
    echo "URL: $url" . PHP_EOL;
    echo "HTTP: $httpCode" . PHP_EOL;
    $decoded = json_decode($response, true);
    print_r($decoded ?? $response);
    echo PHP_EOL;
}

buildAndPost(
    'https://securepayments.neoleap.com.sa/pg/payment/hosted.htm',
    $key, $iv, $config,
    'hosted.htm (Bank Hosted)'
);

sleep(1);

buildAndPost(
    'https://securepayments.neoleap.com.sa/pg/payment/tranportal.htm',
    $key, $iv, $config,
    'tranportal.htm (Merchant Hosted)'
);
