<?php
namespace Cofa\NeoleapIntegrationPackage\DTOs;

class CardOnFileRegistrationData
{
    public readonly string $cardOnFileAction;

    public function __construct(
        public readonly string $cardNo,
        public readonly string $expMonth,
        public readonly string $expYear,
        public readonly ?string $cardOnFileToken = null,
    ) {
        $this->cardOnFileAction = 'registration';
    }

    public function toTrandataArray(string $id, string $password): array
    {
        $data = [
            'password'          => $password,
            'id'                => $id,
            'cardNo'            => $this->cardNo,
            'expMonth'          => $this->expMonth,
            'expYear'           => $this->expYear,
            'cardOnFileAction'  => $this->cardOnFileAction,
        ];

        if ($this->cardOnFileToken !== null) {
            $data['cardOnFileToken'] = $this->cardOnFileToken;
        }

        return $data;
    }
}
