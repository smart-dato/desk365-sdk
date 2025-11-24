<?php

namespace SmartDato\Desk365\Requests\Companies;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\Desk365\Requests\Desk365Request;

class CreateCompanyRequest extends Desk365Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        // TODO: Add company data parameters or CreateCompanyData class
    ) {}

    public function resolveEndpoint(): string
    {
        return '/companies/create';
    }

    protected function defaultBody(): array
    {
        // TODO: Implement body
        return [];
    }
}
