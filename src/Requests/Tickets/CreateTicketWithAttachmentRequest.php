<?php

namespace SmartDato\Desk365\Requests\Tickets;

use Saloon\Contracts\Body\HasBody;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasMultipartBody;
use SmartDato\Desk365\Data\Tickets\CreateTicketData;
use SmartDato\Desk365\Requests\Desk365Request;

class CreateTicketWithAttachmentRequest extends Desk365Request implements HasBody
{
    use HasMultipartBody;

    protected Method $method = Method::POST;

    /**
     * @param  array<string>  $files  Array of file paths to attach
     */
    public function __construct(
        protected CreateTicketData $data,
        protected array $files = [],
    ) {}

    public function resolveEndpoint(): string
    {
        return '/tickets/create_with_attachment';
    }

    /**
     * @return array<MultipartValue>
     *
     * @throws \JsonException
     */
    protected function defaultBody(): array
    {
        $body = [
            new MultipartValue(
                name: 'ticket_object',
                value: json_encode($this->data->toApiArray(), JSON_THROW_ON_ERROR),
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
