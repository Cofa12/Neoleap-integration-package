<?php
namespace Cofa\NeoleapIntegrationPackage\DTOs;

class CardOnFilePaymentData
{
    public readonly string $cardOnFileAction;

    public function __construct(
        public readonly int $amt,
        public readonly string $cardOnFileToken,
        public readonly string $maskedCardNo,
        public readonly string $cvv2,
        public readonly string $member,
        public readonly string $cardType,
        public readonly string $expMonth,
        public readonly string $expYear,
        public readonly int $action = 1,
        public readonly int $currencyCode = 682,
        public readonly string $udf1 = '',
        public readonly string $udf2 = '',
        public readonly string $udf3 = '',
        public readonly string $udf4 = '',
        public readonly string $udf5 = '',
    ) {
        $this->cardOnFileAction = 'transaction';
    }

    public function toTrandataArray(string $id, string $password, string $trackId): array
    {
        return [
            'amt'               => number_format($this->amt, 2, '.', ''),
            'action'            => (string) $this->action,
            'password'          => $password,
            'id'                => $id,
            'currencyCode'      => (string) $this->currencyCode,
            'trackId'           => $trackId,
            'expYear'           => $this->expYear,
            'expMonth'          => $this->expMonth,
            'member'            => $this->member,
            'cvv2'              => $this->cvv2,
            'cardType'          => $this->cardType,
            'cardOnFileAction'  => $this->cardOnFileAction,
            'cardOnFileToken'   => $this->cardOnFileToken,
            'maskedCardNo'      => $this->maskedCardNo,
            'udf1'              => $this->udf1,
            'udf2'              => $this->udf2,
            'udf3'              => $this->udf3,
            'udf4'              => $this->udf4,
            'udf5'              => $this->udf5,
        ];
    }
}
