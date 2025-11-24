<?php

namespace SmartDato\Desk365\Requests\Contacts;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\Desk365\Requests\Desk365Request;

class UpdateContactRequest extends Desk365Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(
        protected string $email,
        // TODO: Add update data parameters or UpdateContactData class
    ) {}

    public function resolveEndpoint(): string
    {
        return '/contacts/update';
    }

    protected function defaultQuery(): array
    {
        return [
            'email' => $this->email,
        ];
    }

    protected function defaultBody(): array
    {
        // TODO: Implement body
        return [];
    }
}
