<?php

namespace SmartDato\Desk365\Requests\KnowledgeBase\Folders;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\Desk365\Requests\Desk365Request;

class UpdateFolderRequest extends Desk365Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(
        protected int $folderId,
        // TODO: Add update data parameters or UpdateFolderData class
    ) {}

    public function resolveEndpoint(): string
    {
        return '/kb/folder/update';
    }

    protected function defaultQuery(): array
    {
        return [
            'folder_id' => $this->folderId,
        ];
    }

    protected function defaultBody(): array
    {
        // TODO: Implement body
        return [];
    }
}
