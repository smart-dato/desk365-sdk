<?php

namespace SmartDato\Desk365\Requests\Contacts;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\Desk365\Requests\Desk365Request;

class CreateContactRequest extends Desk365Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        // TODO: Add contact data parameters or CreateContactData class
    ) {}

    public function resolveEndpoint(): string
    {
        return '/contacts/create';
    }

    protected function defaultBody(): array
    {
        // TODO: Implement body
        return [];
    }
}
