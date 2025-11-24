<?php

namespace SmartDato\Desk365\Requests\Contacts;

use Saloon\Enums\Method;
use SmartDato\Desk365\Requests\Desk365Request;

class GetContactDetailsRequest extends Desk365Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected string $email,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/contacts/details';
    }

    protected function defaultQuery(): array
    {
        return [
            'email' => $this->email,
        ];
    }
}
