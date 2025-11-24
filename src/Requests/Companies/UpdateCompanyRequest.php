<?php

namespace SmartDato\Desk365\Requests\Companies;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\Desk365\Requests\Desk365Request;

class UpdateCompanyRequest extends Desk365Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(
        protected string $name,
        // TODO: Add update data parameters or UpdateCompanyData class
    ) {}

    public function resolveEndpoint(): string
    {
        return '/companies/update';
    }

    protected function defaultQuery(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    protected function defaultBody(): array
    {
        // TODO: Implement body
        return [];
    }
}
