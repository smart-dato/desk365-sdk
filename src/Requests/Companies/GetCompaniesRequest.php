<?php

namespace SmartDato\Desk365\Requests\Companies;

use Saloon\Enums\Method;
use SmartDato\Desk365\Requests\Desk365Request;

class GetCompaniesRequest extends Desk365Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected ?int $offset = null,
    ) {
        // TODO: Add query parameters (pagination, filters, etc.)
    }

    public function resolveEndpoint(): string
    {
        return '/companies';
    }

    protected function defaultQuery(): array
    {
        return array_filter([
            'offset' => $this->offset,
        ], static fn ($value) => $value !== null);
    }
}
