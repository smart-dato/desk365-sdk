<?php

namespace SmartDato\Desk365\Requests\Tickets;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\Desk365\Data\Tickets\CreateTicketData;
use SmartDato\Desk365\Requests\Desk365Request;

class CreateTicketRequest extends Desk365Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected CreateTicketData $data,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/tickets/create';
    }

    protected function defaultBody(): array
    {
        return $this->data->toApiArray();
    }
}
