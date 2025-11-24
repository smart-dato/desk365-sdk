<?php

namespace SmartDato\Desk365\Requests\Tickets;

use Saloon\Enums\Method;
use SmartDato\Desk365\Concerns\ConvertsBoolToInt;
use SmartDato\Desk365\Enums\ConversationSortBy;
use SmartDato\Desk365\Requests\Desk365Request;

class GetTicketConversationsRequest extends Desk365Request
{
    use ConvertsBoolToInt;

    protected Method $method = Method::GET;

    public function __construct(
        protected int $ticketNumber,
        protected ?ConversationSortBy $sortBy = null,
        protected ?bool $includeContactReplies = null,
        protected ?bool $includeAgentReplies = null,
        protected ?bool $includePrivateNotes = null,
        protected ?bool $includePublicNotes = null,
        protected ?bool $includeForwardMessages = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/tickets/conversations';
    }

    protected function defaultQuery(): array
    {
        return array_filter([
            'ticket_number' => $this->ticketNumber,
            'sort_by' => $this->sortBy?->value,
            'include_contact_replies' => $this->boolToInt($this->includeContactReplies),
            'include_agent_replies' => $this->boolToInt($this->includeAgentReplies),
            'include_private_notes' => $this->boolToInt($this->includePrivateNotes),
            'include_public_notes' => $this->boolToInt($this->includePublicNotes),
            'include_forward_messages' => $this->boolToInt($this->includeForwardMessages),
        ], static fn ($value) => $value !== null);
    }
}
