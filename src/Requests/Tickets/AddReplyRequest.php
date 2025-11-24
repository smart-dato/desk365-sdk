<?php

namespace SmartDato\Desk365\Requests\Tickets;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\Desk365\Concerns\ConvertsBoolToInt;
use SmartDato\Desk365\Requests\Desk365Request;

class AddReplyRequest extends Desk365Request implements HasBody
{
    use ConvertsBoolToInt;
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected int $ticketNumber,
        protected string $replyBody,
        protected ?string $ccEmails = null,
        protected ?string $bccEmails = null,
        protected ?string $agentEmail = null,
        protected ?string $fromEmail = null,
        protected ?bool $includePrevCcs = null,
        protected ?bool $includePrevMessages = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/tickets/add_reply';
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
            'body' => $this->replyBody,
            'cc_emails' => $this->ccEmails,
            'bcc_emails' => $this->bccEmails,
            'agent_email' => $this->agentEmail,
            'from_email' => $this->fromEmail,
            'include_prev_ccs' => $this->boolToInt($this->includePrevCcs),
            'include_prev_messages' => $this->boolToInt($this->includePrevMessages),
        ], static fn ($value) => $value !== null);
    }
}
