<?php

namespace SmartDato\Desk365\Requests\Companies;

use Saloon\Enums\Method;
use SmartDato\Desk365\Requests\Desk365Request;

class GetCompanyDetailsRequest extends Desk365Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected string $name,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/companies/details';
    }

    protected function defaultQuery(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
