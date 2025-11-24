<?php

namespace SmartDato\Desk365\Requests\Tickets;

use Saloon\Contracts\Body\HasBody;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasMultipartBody;
use SmartDato\Desk365\Enums\Tickets\TicketVisibility;
use SmartDato\Desk365\Requests\Desk365Request;

class AddNoteWithAttachmentRequest extends Desk365Request implements HasBody
{
    use HasMultipartBody;

    protected Method $method = Method::POST;

    /**
     * @param  array<string>  $files  Array of file paths to attach
     */
    public function __construct(
        protected int $ticketNumber,
        protected string $noteBody,
        protected array $files = [],
        protected ?string $agentEmail = null,
        protected ?string $notifyEmails = null,
        protected ?TicketVisibility $visibility = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/tickets/add_note_with_attachment';
    }

    /**
     * @return array<MultipartValue>
     *
     * @throws \JsonException
     */
    protected function defaultBody(): array
    {
        $noteData = array_filter([
            'body' => $this->noteBody,
            'agent_email' => $this->agentEmail,
            'notify_emails' => $this->notifyEmails,
            'private_note' => $this->visibility?->value,
        ], static fn ($value) => $value !== null);

        $body = [
            new MultipartValue(
                name: 'ticket_number',
                value: (string) $this->ticketNumber,
            ),
            new MultipartValue(
                name: 'note_object',
                value: json_encode($noteData, JSON_THROW_ON_ERROR),
            ),
        ];

        foreach ($this->files as $filePath) {
            $body[] = new MultipartValue(
                name: 'files',
                value: fopen($filePath, 'rb'),
                filename: basename($filePath),
            );
        }

        return $body;
    }
}
