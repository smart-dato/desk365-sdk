<?php

namespace SmartDato\Desk365\Requests\Contracts;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\Desk365\Requests\Desk365Request;

class UpdateContractRequest extends Desk365Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(
        protected int $contractId,
        // TODO: Add update data parameters or UpdateContractData class
    ) {}

    public function resolveEndpoint(): string
    {
        return '/contracts/update';
    }

    protected function defaultQuery(): array
    {
        return [
            'contract_id' => $this->contractId,
        ];
    }

    protected function defaultBody(): array
    {
        // TODO: Implement body
        return [];
    }
}
