<?php

namespace SmartDato\Desk365\Requests\Tickets;

use Saloon\Contracts\Body\HasBody;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasMultipartBody;
use SmartDato\Desk365\Concerns\ConvertsBoolToInt;
use SmartDato\Desk365\Requests\Desk365Request;

class AddReplyWithAttachmentRequest extends Desk365Request implements HasBody
{
    use ConvertsBoolToInt;
    use HasMultipartBody;

    protected Method $method = Method::POST;

    /**
     * @param  array<string>  $files  Array of file paths to attach
     */
    public function __construct(
        protected int $ticketNumber,
        protected string $replyBody,
        protected array $files = [],
        protected ?string $ccEmails = null,
        protected ?string $bccEmails = null,
        protected ?string $agentEmail = null,
        protected ?string $fromEmail = null,
        protected ?bool $includePrevCcs = null,
        protected ?bool $includePrevMessages = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/tickets/add_reply_with_attachment';
    }

    /**
     * @return array<MultipartValue>
     *
     * @throws \JsonException
     */
    protected function defaultBody(): array
    {
        $replyData = array_filter([
            'body' => $this->replyBody,
            'cc_emails' => $this->ccEmails,
            'bcc_emails' => $this->bccEmails,
            'agent_email' => $this->agentEmail,
            'from_email' => $this->fromEmail,
            'include_prev_ccs' => $this->boolToInt($this->includePrevCcs),
            'include_prev_messages' => $this->boolToInt($this->includePrevMessages),
        ], static fn ($value) => $value !== null);

        $body = [
            new MultipartValue(
                name: 'ticket_number',
                value: (string) $this->ticketNumber,
            ),
            new MultipartValue(
                name: 'reply_object',
                value: json_encode($replyData, JSON_THROW_ON_ERROR),
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
