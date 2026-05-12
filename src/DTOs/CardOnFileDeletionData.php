<?php
namespace Cofa\NeoleapIntegrationPackage\DTOs;

class CardOnFileDeletionData
{
    public readonly string $cardOnFileAction;

    public function __construct(
        public readonly string $cardOnFileToken,
    ) {
        $this->cardOnFileAction = 'deletion';
    }

    public function toTrandataArray(string $id, string $password): array
    {
        return [
            'password'         => $password,
            'id'               => $id,
            'cardOnFileToken'  => $this->cardOnFileToken,
            'cardOnFileAction' => $this->cardOnFileAction,
        ];
    }
}
