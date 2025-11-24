<?php

namespace SmartDato\Desk365\Requests\Contacts;

use Saloon\Enums\Method;
use SmartDato\Desk365\Requests\Desk365Request;

class GetContactsRequest extends Desk365Request
{
    protected Method $method = Method::GET;

    public function __construct()
    {
        // TODO: Add query parameters (pagination, filters, etc.)
    }

    public function resolveEndpoint(): string
    {
        return '/contacts';
    }
}
