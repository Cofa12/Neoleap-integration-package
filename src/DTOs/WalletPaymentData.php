<?php
namespace Cofa\NeoleapIntegrationPackage\DTOs;

class WalletPaymentData
{
    public readonly string $trackId;

    public function __construct(
        public readonly int $amt,
        public readonly string $mobileNumber,
        public readonly int $action = 1,
        public readonly int $currencyCode = 682,
        public readonly string $udf1 = '',
        public readonly string $udf2 = '',
        public readonly string $udf3 = '',
        public readonly string $udf4 = '',
        public readonly string $udf5 = '',
        string $trackId = '',
    ) {
        if (!preg_match('/^\d{9}$/', $mobileNumber)) {
            throw new \InvalidArgumentException('mobileNumber must be exactly 9 digits.');
        }
        $this->trackId = $trackId !== '' ? $trackId : (string) time();
    }

    public function toTrandataArray(string $id, string $password, string $responseURL, string $errorURL): array
    {
        return [
            'amt'         => number_format($this->amt, 2, '.', ''),
            'action'      => (string) $this->action,
            'password'    => $password,
            'id'          => $id,
            'currencyCode'=> (string) $this->currencyCode,
            'trackId'     => $this->trackId,
            'mobileNumber'=> $this->mobileNumber,
            'responseURL' => $responseURL,
            'errorURL'    => $errorURL,
            'udf1'        => $this->udf1,
            'udf2'        => $this->udf2,
            'udf3'        => $this->udf3,
            'udf4'        => $this->udf4,
            'udf5'        => $this->udf5,
        ];
    }
}
