<?php

namespace SmartDato\Desk365\Requests\Contracts;

use Saloon\Enums\Method;
use SmartDato\Desk365\Requests\Desk365Request;

class GetContractDetailsRequest extends Desk365Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $contractId,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/contracts/details';
    }

    protected function defaultQuery(): array
    {
        return [
            'contract_id' => $this->contractId,
        ];
    }
}
