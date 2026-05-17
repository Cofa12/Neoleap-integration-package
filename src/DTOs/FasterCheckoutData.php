<?php
namespace Cofa\NeoleapIntegrationPackage\DTOs;

class FasterCheckoutData
{
    public readonly string $trackId;

    public function __construct(
        public readonly float $amt,
        public readonly string $custid,
        public readonly int $action = 1,
        public readonly int $currencyCode = 682,
        public readonly string $udf1 = '',
        public readonly string $udf2 = '',
        public readonly string $udf3 = '',
        public readonly string $udf4 = '',
        public readonly string $udf5 = '',
        public readonly ?string $responseURL = null,
        public readonly ?string $errorURL = null,
        public readonly ?string $custCardHolderName = null,
        public readonly ?string $custMobileNumber = null,
        public readonly ?string $custEmailId = null,
        public readonly string $langid = 'ar',
        string $trackId = '',
    ) {
        if ($custid === '') {
            throw new \InvalidArgumentException('custid is required for Faster Checkout.');
        }
        $this->trackId = $trackId !== '' ? $trackId : (string) time();
    }

    public function toTrandataArray(string $id, string $password, string $responseURL, string $errorURL): array
    {
        $data = [
            'amt'          => number_format($this->amt, 2, '.', ''),
            'action'       => (string) $this->action,
            'password'     => $password,
            'id'           => $id,
            'currencyCode' => (string) $this->currencyCode,
            'trackId'      => $this->trackId,
            'responseURL'  => $this->responseURL ?? $responseURL,
            'errorURL'     => $this->errorURL ?? $errorURL,
            'custid'       => $this->custid,
            'udf1'         => $this->udf1,
            'udf2'         => $this->udf2,
            'udf3'         => $this->udf3,
            'udf4'         => $this->udf4,
            'udf5'         => $this->udf5,
            'langid'       => $this->langid,
        ];

        if ($this->custCardHolderName !== null) {
            $data['cust_cardHolderName'] = $this->custCardHolderName;
        }
        if ($this->custMobileNumber !== null) {
            $data['cust_mobile_number'] = $this->custMobileNumber;
        }
        if ($this->custEmailId !== null) {
            $data['cust_emailId'] = $this->custEmailId;
        }

        return $data;
    }
}
