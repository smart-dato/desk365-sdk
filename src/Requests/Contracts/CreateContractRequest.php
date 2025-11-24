<?php

namespace SmartDato\Desk365\Requests\Contracts;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\Desk365\Requests\Desk365Request;

class CreateContractRequest extends Desk365Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        // TODO: Add contract data parameters or CreateContractData class
    ) {}

    public function resolveEndpoint(): string
    {
        return '/contracts/create';
    }

    protected function defaultBody(): array
    {
        // TODO: Implement body
        return [];
    }
}
