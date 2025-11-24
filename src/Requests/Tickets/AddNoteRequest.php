<?php

namespace SmartDato\Desk365\Requests\Tickets;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\Desk365\Enums\Tickets\TicketVisibility;
use SmartDato\Desk365\Requests\Desk365Request;

class AddNoteRequest extends Desk365Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected int $ticketNumber,
        protected string $noteBody,
        protected ?string $agentEmail = null,
        protected ?string $notifyEmails = null,
        protected ?TicketVisibility $visibility = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/tickets/add_note';
    }

    protected function defaultQuery(): array
    {
        return [
            'ticket_number' => $this->ticketNumber,
        ];
    }

    protected function defaultBody(): array
    {
        return array_filter([
            'body' => $this->noteBody,
            'agent_email' => $this->agentEmail,
            'notify_emails' => $this->notifyEmails,
            'private_note' => $this->visibility?->value,
        ], static fn ($value) => $value !== null);
    }
}
