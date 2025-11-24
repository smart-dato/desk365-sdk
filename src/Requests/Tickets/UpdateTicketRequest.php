<?php

namespace SmartDato\Desk365\Requests\Tickets;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\Desk365\Data\Tickets\UpdateTicketData;
use SmartDato\Desk365\Requests\Desk365Request;

class UpdateTicketRequest extends Desk365Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(
        protected int $ticketNumber,
        protected UpdateTicketData $data,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/tickets/update';
    }

    protected function defaultQuery(): array
    {
        return [
            'ticket_number' => $this->ticketNumber,
        ];
    }

    protected function defaultBody(): array
    {
        return $this->data->toApiArray();
    }
}
