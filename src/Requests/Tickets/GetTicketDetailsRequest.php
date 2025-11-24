<?php

namespace SmartDato\Desk365\Requests\Tickets;

use Saloon\Enums\Method;
use SmartDato\Desk365\Requests\Desk365Request;

class GetTicketDetailsRequest extends Desk365Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $ticketNumber,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/tickets/details';
    }

    protected function defaultQuery(): array
    {
        return [
            'ticket_number' => $this->ticketNumber,
        ];
    }
}
